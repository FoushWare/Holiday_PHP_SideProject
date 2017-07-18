<?php
session_start();
$pageTitle="Members";

/*Check if the user came through an Authorized place
    [have record in the DATABASE --came form login form or dashboard]
 */

if(isset($_SESSION['Username'])){

    include 'init.php';
    //This variable $do we will use it to split the page
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


//This Step will split the Page
if($do == 'Edit'){ //brace stat of Edit page

        /*****Don't forget we pass the userid with the URL to make changes to the user profile
         ***i know this can be hackable cause if i change $userid from URL i'll
         *** change setting of other user  ---but-- :) this account for admin and
         ***he/she have every privileges of him and all users*/
     $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        //SELECT All data depend of this id
        $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

        $stmt->execute(array($userid));
        $row=$stmt->fetch();
        $count= $stmt->rowCount();
if($count>0){//if the user exists it will go to the form
?>

        <div class="container">
        <h1 class="text-center">Edit Member</h1>

        <form class="form-horizontal" action="?do=Update" method="POST">

            <!-- START OF this is a hidden input to send userid to Update page so no anyone see anything :> -->
            <input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
            <!-- End OF this is a hidden input to send userid to Update page so no anyone see anything :> -->
        <!-- Start username Field-->
            <div class="form-group form-group-lg">
                    <label  class="col-sm-2 control-label">UserName</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username" value="<?php echo  $row['Username']?>"/>
                    </div>

            </div>
        <!-- End username Field-->

        <!-- Start Email Field-->
            <div class="form-group form-group-lg">
                <label  class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                <input type="email" name="email" class="form-control" autocomplete="off" required="required" placeholder="Email" value="<?php echo  $row['Email']?>"/>
                </div>
            </div>
        <!-- End Email Field-->

        <!-- Start Password Field-->
            <div class="form-group form-group-lg">
                <label  class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                <input type="hidden" name="OldPassword" value="<?php echo $row['Password']?>" />
                    <input type="password" name="NewPassword" class="form-control col-sm-10" autocomplete="new-password" required="required" placeholder="password"/>
                </div>

            </div>
        <!-- End Password Field-->

        <!-- End FullName Field-->

            <div class="form-group form-group-lg">
                <label  class="col-sm-2 control-label">FullName</label>
                <div class="col-sm-10">
                    <input type="text" name="full" class="form-control col-sm-10" autocomplete="off" required="required" placeholder="FullName" value="<?php echo  $row['FullName']?>"/>
                </div>

            </div>

        <!-- End FullName Field-->

            <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type='submit' value="save" class="btn btn-primary btn-lg"/>
                    </div>
            </div>

        </form>
        </div>  <!--End of container-->

<?php }//End of count>0 condition

//if there is no id with that request
else{
    echo "<div class='container'>";

    $theMsg="<div class='alert alert-danger'>There is  No such ID</div>";
    redirectHome($theMsg);

    echo"</div>";


}

?>

<?php } //brace End of Edit page


else if($do == 'Add'){ //brace start of Add page


?>



        <div class="container">
        <h1 class="text-center">Add Member</h1>

        <form class="form-horizontal" action="?do=Insert" method="POST">

            <!-- START OF this is a hidden input to send userid to Update page so no anyone see anything :> -->
            <input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
            <!-- End OF this is a hidden input to send userid to Update page so no anyone see anything :> -->
        <!-- Start username Field-->
            <div class="form-group form-group-lg">
                    <label  class="col-sm-2 control-label">UserName</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username"/>
                    </div>

            </div>
        <!-- End username Field-->

        <!-- Start Email Field-->
            <div class="form-group form-group-lg">
                <label  class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                <input type="email" name="email" class="form-control" autocomplete="off" required="required" placeholder="Email"/>
                </div>
            </div>
        <!-- End Email Field-->

        <!-- Start Password Field-->
            <div class="form-group form-group-lg">
                <label  class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="pass" class="form-control col-sm-10" autocomplete="new-password" required="required" placeholder="password"/>
                        <i class="fa fa-eye fa-2x show-pass"></i>
                </div>

            </div>
        <!-- End Password Field-->

        <!-- End FullName Field-->

            <div class="form-group form-group-lg">
                <label  class="col-sm-2 control-label">FullName</label>
                <div class="col-sm-10">
                    <input type="text" name="full" class="form-control col-sm-10" autocomplete="off" required="required" placeholder="FullName"/>
                </div>

            </div>

        <!-- End FullName Field-->

            <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type='submit' value="Add Member" class="btn btn-primary btn-lg"/>
                    </div>
            </div>

        </form>
        </div>  <!--End of container-->



<?php } //brace End of Add page


else if($do == 'Manage'){//brace start of Manage page

$query="";

if(isset($_GET['page']) && $_GET['page']=="Pending"){
$query="AND RegStatus = 0";
}





//select all users from the database except admin and list them to the table

    $stmt= $con-> prepare("SELECT * FROM users WHERE GroupID !=1 $query ORDER BY UserID DESC");
    $stmt->execute();
    $rows=$stmt->fetchAll();
?>

<div class="container">
<h1 class="text-center">Manage Members</h1>
    <table class="main-table table-responsive table table-bordered text-center  table-striped table-hover ">
        <thead>
          <tr>
            <th>#ID</th>
            <th>UserName</th>
            <th>Email</th>
            <th>FullName</th>
            <th>Registeration Date </th>
            <th>Control</th>
          </tr>

        </thead>

        <tbody>

            <?php

    if(is_array($rows) || is_object($row)){

    foreach($rows as $user){


             echo '<tr>';
                    echo'<td>'.$user['UserID'].'</td>';
                    echo'<td>'.$user['Username'].'</td>';
                    echo'<td>'.$user['Email'].'</td>';
                    echo'<td>'.$user['FullName'].'</td>';
                    echo'<td>'.$user['Date'].'</td>';
                    echo'<td>';
                    echo '<a class="btn btn-primary Edit" href="members.php?do=Edit&&userid='.$user['UserID'].'"><i class="fa fa-edit"></i>Edit</a>';
                    echo ' <a class="btn btn-danger Delete confirm" href="members.php?do=Delete&&userid='.$user['UserID'].'"><i class="fa fa-close"></i>Delete</a>';
                    if($user['RegStatus']==0){
                    echo ' <a class="btn btn-info info" href="members.php?do=Activate&&userid='.$user['UserID'].'"><i class="fa fa-close"></i>Activate</a>';
                    }
                         echo'</td>';

                        echo '</tr>';
    }//End of foreach

}//End of check if  row is array
            ?>
        </tbody>
    </table>
    <a class="btn btn-primary" href="members.php?do=Add"><i class="fa fa-plus"></i> Add Member</a>
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


?>




<?php } //brace End of Insert page

else if($do == 'Update'){//brace Start of Update page
    /*check if the user came from the FORM with POST REQUEST
     *and collect the data from the form to use it with SQL statement
     * to update his/her setting
     * */

    echo '<div class="container">';

    if($_SERVER['REQUEST_METHOD']=='POST'){

    echo '<h1 class="text-center">Update Member</h1>';
        //Then collect info from FORM :>
        $id=$_POST['userid'];
        $user=$_POST['username'];
        $email=$_POST['email'];
        $name=$_POST['full'];
        //password trick
        $pass=empty($_POST['NewPassword']) ? $_POST['OldPassword'] : $_POST['NewPassword'];

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


//if there is no errors we will update the user  datatbase

if(empty($formError)){
    $stmt=$con->prepare("UPDATE users SET Username=?,Email=?,Fullname=?,Password = ? WHERE UserID=?");
    $stmt->execute(array($user,$email,$name,$pass,$id));
    echo $stmt->rowCount(). 'updated';
}





}//End of REQUEST_METHOD check

else{
    echo '</br>';
   $theMsg='<div class="alert alert-danger">sorry you can not browse this page</div>';
    redirectHome($theMsg);
}

echo '</div>'; //End of container of the page

?>
<?php } //brace End of Update page

else if($do == 'Delete'){ //brace start of Delete page

     $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

     /*Check if the user i want to delete exists in db :
      * this for security cause someone cant type to the url
      * id that do not exists
      */
$count=checkItem('UserID','users',$userid);
     if( $count >0 )//this mean the user exists in db delete him/her :)
        {

echo '<div class="container">';
            $stmt2= $con->prepare("DELETE FROM users WHERE UserID= :Xuserid");
             $stmt2->bindParam(":Xuserid",$userid);
            $stmt2->execute();
            echo '</br>';
            echo '<div class="alert alert-success text-center h1">You have delete this user :)</div>';

        }
else{//if the user not in the db
            echo '</br>';
     $theMsg='<div class="alert alert-danger text-center h1">the user is not in our db :)</div>';
    redirectHome($theMsg,'back');
}


echo '</div>';


?>

<?php } //brace End of Delete page


else if($do == 'Activate'){ //brace start of Activate page

    echo 'Hello from Activate';

     $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

     /*Check if the user i want to delete exists in db :
      * this for security cause someone cant type to the url
      * id that do not exists
      */
$count=checkItem('UserID','users',$userid);
     if( $count >0 )//this mean the user exists in db delete him/her :)
        {

echo '<div class="container">';
            $stmt2= $con->prepare("UPDATE users SET RegStatus=1  WHERE UserID= :Xuserid");
             $stmt2->bindParam(":Xuserid",$userid);
            $stmt2->execute();
            echo '</br>';
           $theMsg ='<div class="alert alert-success text-center h1">You have Activate this user :)</div>';
            redirectHome($theMsg,'back');
        }
else{//if the user not in the db
            echo '</br>';
     $theMsg='<div class="alert alert-danger text-center h1">the user is not in our db :)</div>';
    redirectHome($theMsg);
}


echo '</div>';


?>
<?php } //brace End of Activate page

?>




<?php include $tpl.'footer.php'; ?>

<?php } //this brace for the ending of session condition

else{  //if there is no session [this mean that user use urL direct without being in the DATABASE]

    //Redirect him to login
    header('Location:index.php');
    exit();

}

?>






