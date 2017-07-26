<?php
session_start();
$pageTitle='Items';
if($_SESSION['Username']){

        include 'init.php';

        $do=isset($_GET['do'])?$_GET['do']:"Manage";


        if($do=='Manage'){


            $stmt=$con->prepare("SELECT items.*, categories.name AS
                                                 Category_Name
                                                 ,users.Username AS
                                                 User_Name
                                FROM items
                                INNER JOIN categories ON
                                    categories.ID = items.Cat_ID
                                INNER JOIN users ON
                                    users.UserID = items.Member_ID");
    $stmt->execute();
    $items=$stmt->fetchAll();
?>

<div class="container">
<h1 class="text-center">Manage Members</h1>
    <table class="main-table table-responsive table table-bordered text-center  table-striped table-hover ">
        <thead>
          <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Add_Date</th>
            <th>Country_Made</th>
            <th>Memeber</th>
            <th>category</th>
            <th>Control</th>
          </tr>

        </thead>

        <tbody>

                        <?php

                if(is_array($items) || is_object($items)){

                            foreach($items as $item){
                                     echo '<tr>';
                                            echo'<td>'.$item['item_ID'].'</td>';
                                            echo'<td>'.$item['Name'].'</td>';
                                            echo'<td>'.$item['Description'].'</td>';
                                            echo'<td>'.$item['Price'].'</td>';
                                            echo'<td>'.$item['Add_Date'].'</td>';
                                            echo'<td>'.$item['Country_Made'].'</td>';
                                            echo'<td>'.$item['Category_Name'].'</td>';
                                            echo'<td>'.$item['User_Name'].'</td>';
                                            echo'<td>';
                                            echo '<a class="btn btn-primary Edit" href="items.php?do=Edit&&itemId='.$item['item_ID'].'"><i class="fa fa-edit"></i>Edit</a>';
                                            echo ' <a class="btn btn-danger Delete confirm" href="items.php?do=Delete&&itemId='.$item['item_ID'].'"><i class="fa fa-close"></i>Delete</a>';
                                            echo'</td>';
                                     echo '</tr>';
                            }//End of foreach

                    }//End of check if  row is array
                        ?>
        </tbody>
    </table>
    <a class="btn btn-primary member_add" href="items.php?do=Add"><i class="fa fa-plus"></i> Add Member</a>
</div>




<?php } //brace End of Manage page

else if($do == 'Insert'){ //brace Start of Insert page

    //check if the method is POST or not
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

echo '<div class="container">';
echo '<h1 class="text-center">Insert Member</h1>';

//get the info of the new user to insert it in the db
$user=$_POST['username'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$name=$_POST['full'];

/*Form validation*/
        $formError=array();
        if(strlen($user)<3){$formError[]="Username can't be less than <strong>3</strong>";}
        else if(empty($user)){$formError[]="Username can't be<strong> empty</strong>";}
        else if(empty($email)){$formError="email can't be<strong> empty</strong>";}
        else if(empty($name)){$formError="fullName can't be<strong> empty</strong>";}

//Loop through the error
            foreach($formError as $error){
                echo '<div class="alert alert-danger">' . $error .'</div>';
}


if(empty($formError)){ //if the form is added correctly

/*first check if the New-user exists in the db or not
 * to not conflict result and haveing dublecated users
 */

$count=checkItem('Username','users',$user);
        if($count == 0){ //the username isn't in the db so i can add him/her




            $stmt2 = $con->prepare("INSERT INTO users(Username , Password , Email,FullName,RegStatus,Date)
                                    VALUES(:Xuser, :Xpass, :XEmail,:XFullName,1,now())");
            $stmt2->execute(array(

                ':Xuser'         =>      $user,
                ':Xpass'         =>      $pass ,
                ':XEmail'        =>      $email,
                ":XFullName"     =>      $name
            ));

                $theMsg='<div class="alert alert-success h1 text-center">You have added new user :) </div>';
                redirectHome($theMsg,'back');

        }//End of [if condition] for count
        else{//the user is exits in the db you can't insert him

                $theMsg='<div class="alert alert-danger h1 text-center">The user is already exists </div>';
                redirectHome($theMsg,'back');
}


} //end of if there is no error

}else{// user get direct not from POST request

$theMsg='<div class="alert alert-danger h1 text-center">You can not browse this page direct</div>';

                redirectHome($theMsg);
}


            echo"hello form ".$do." from ".$pageTitle;


?>









<?php

}//End brace of Manage

else if($do=="Add"){
?>


<div class="container">

    <h1 class="text-center">Add New item </h1>

    <form class="form-horizontal main_form" action="items.php?do=Insert" method="POST">

        <div class=" form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-6">
                <input type="text"
                       name="Name"
                       class="form-control"
                       placeholder="Name of the item"
                       required="required"
                       />
           </div>

        </div> <!--End of form group-->

        <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           name="Description"
                           class="form-control"
                           placeholder="Describe of the item"
                           required="required"
                          />
               </div>

        </div> <!--End of form group-->

         <div class=" form-group form-group-lg">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10 col-md-6">
                    <input type="text"
                           name="Price"
                           class="form-control"
                           placeholder="price of the item"
                           required="required"
                           />
               </div>

        </div> <!--End of form group-->

        <div class=" form-group form-group-lg">
                        <label class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text"
                                   name="Country_Made"
                                   class="form-control"
                                   placeholder="Country of Made"
                                   required="required"
                                   />
                        </div>

                </div> <!--End of form group-->
        <div class=" form-group form-group-lg">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select class="form-control" name="status">
                                <option value="0">...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
        </div> <!--End of form group-->

<!--Start Member section-->
        <div class=" form-group form-group-lg">
                        <label class="col-sm-2 control-label">Member</label>
                        <div class="col-sm-10 col-md-6">
                            <select class="form-control" name="member"  >
                                <option value="0">...</option>
                                <?php
                                    $stmt=$con->prepare("SELECT * FROM users ");
                                    $stmt->execute();
                                    $users=$stmt->fetchAll();
                                    foreach($users as $user){
                                        echo'<option value="'.$user['UserID'].' ">'.$user['Username'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
        </div> <!--End of form group-->

<!--Start category section-->
        <div class=" form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-md-6">
                            <select class="form-control" name="category"  >
                                <option value="0">...</option>
                                <?php
                                    $stmt=$con->prepare("SELECT * FROM categories ");
                                    $stmt->execute();
                                    $cats=$stmt->fetchAll();
                                    foreach($cats as $cat){
                                        echo'<option value="'.$cat['ID'].' ">'.$cat['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
        </div> <!--End of form group-->


        <div class=" form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-10">
                <input
                type="submit"
                value="Add item"
                class="btn btn-primary btn-lg"
                            />
            </div>
        </div>



    </form>






</div><!--End of the container-->




















<?php

}//End brace of add

else if($do=="Insert"){
    echo'<div class="container">';
    echo'<h1 class="text-center">Insert Item</h1>';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

//Get all the data from the Add form
    $name=$_POST['Name'];
    $description=$_POST['Description'];
    $price=$_POST['Price'];
    $country=$_POST['Country_Made'];
    $status=$_POST['status'];
    $member=$_POST['member'];
    $category=$_POST['category'];

    $formError=array();


    if(empty($name)){
        $formError[]='Name can\'t be <strong>Empty</strong>';
    }

    if(empty($description)){
        $formError[]='description can\'t be <strong>Empty</strong>';
    }

    if(empty($price)){
        $formError[]='price can\'t be <strong>Empty</strong>';
    }

    if(empty($country)){
        $formError[]='courntry can\'t be <strong>Empty</strong>';
    }
    if(empty($status)){
        $formError[]='You must choose the <strong>Status</strong>';
    }


    if(empty($member)){
        $formError[]='You must choose the <strong>member</strong>';
    }

    if(empty($category)){
        $formError[]='You must choose the <strong>category</strong>';
    }

if(empty($formError)){

//Check if the item is in the items table or not
$itemCount=checkItem('Name','items',$name);

if($itemCount == 0){ //You can add the New item

    $stmt=$con->prepare("INSERT INTO
                                 items(Name,Description,Price,Country_Made,Status
                                        ,Add_Date,Cat_ID,Member_ID)
                                VALUES
                                (:Xname,:XDescription,:Xprice,:Xcountry,:Xstat
                                 ,now(),:Xcat,:Xmem)

" );
$stmt->execute(array(

    'Xname'                 => $name,
    'XDescription'          => $description,
    'Xprice'                => $price,
    'Xcountry'              => $country,
    'Xstat'                 => $status,
    'Xcat'                 =>  $category,
    'Xmem'                 =>  $member

));

    echo'<br>';
        $theMsg='<div class="alert alert-success text-center">Everything OKay</div>';
        redirectHome($theMsg);
    echo'<br>';

}else{//the item is exists you can't add em as New item
    echo'<br>';
        $theMsg='<div class="alert alert-danger text-center">The item is exists in the db already</div>';
        redirectHome($theMsg);
    echo'<br>';
}







}//End brace of  FormError is empty

else{//else if the are elements in the formError

    foreach($formError as $error ){
        echo'<br>';
        echo '<div class="alert alert-danger">'.$error.'</div>';
        echo'<br>';
    }
$theMsg='<div class="alert alert-danger Text-center">Some Errors with Add New item</div>';
redirectHome($theMsg);

}



}//End brace of POST checking


else{//if the user didn't get from the add form
    echo'<br>';
        $theMsg='<div class="alert alert-danger text-center">YOU can not access this page direct</div>';
        redirectHome($theMsg);

    echo'<br>';
}

echo '<div>';//This is for container

?>

<?php

}//End brace of Insert

else if($do=='Update'){


    echo"hello form ".$do;


?>


<?php

}//end brace of update

else if($do=='Edit'){


    echo"hello form ".$do;

?>




<?php
}//End brace of Edit

else if($do=='Delete'){

    echo"hello form ".$do;

?>




<?php
}//End brace of Delete


?>






<?php
include $tpl.'footer.php';

}//End brace of session exists
else{ //if there is no session
    header('Location:index.php');
    exit();
 }
?>
