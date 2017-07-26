<?php
session_start();
$pageTitle='Items';
if($_SESSION['Username']){

        include 'init.php';

        $do=isset($_GET['do'])?$_GET['do']:"Manage";


        if($do=='Manage'){

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

echo '<div class="container">';
    echo'<br>';
        $theMsg='<div class="alert alert-success text-center">Everything OKay</div>';
        redirectHome($theMsg);
    echo'<br>';
echo'</div>';

}else{//the item is exists you can't add em as New item
echo '<div class="container">';
    echo'<br>';
        $theMsg='<div class="alert alert-danger text-center">The item is exists in the db already</div>';
        redirectHome($theMsg);
    echo'<br>';
echo'</div>';
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
echo '<div class="container">';
    echo'<br>';
        $theMsg='<div class="alert alert-danger text-center">YOU can not access this page direct</div>';
        redirectHome($theMsg);

    echo'<br>';
echo '</div>';
}

?>

<?php

}//End brace of Insert

else if($do=='Update'){


    echo"hello form ".$do;


?>


<?php

}//end brace of update




?>









<?php
include $tpl.'footer.php';

}//End brace of session exists
else{ //if there is no session
    header('Location:index.php');
    exit();
 }
?>
