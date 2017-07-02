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
<form class="form-horizontal" action="?do=Update" method="POST">
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
            <input type="password" name="password" class="form-control col-sm-10" autocomplete="new-password" required="required" placeholder="password"/>
        </div>

    </div>
<!-- End Password Field-->

<!-- End FullName Field-->

    <div class="form-group form-group-lg">
        <label  class="col-sm-2 control-label">FullName</label>
        <div class="col-sm-10">
            <input type="text" class="form-control col-sm-10" autocomplete="off" required="required" placeholder="FullName"/>
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
    echo"<div class='alert alert-danger'>There No such ID</div>";
    echo"</div>";


}

?>

<?php } //brace End of Edit page


else if($do == 'Add'){ //brace start of Add page
echo 'Hello from Add';
?>


<?php } //brace End of Add page


else if($do == 'Manage'){//brace start of Manage page

echo 'Hello from Manage';
?>

<?php } //brace End of Manage page


else if($do == 'Insert'){ //brace Start of Insert page

echo 'Hello from Insert';
?>

<?php } //brace End of Insert page

else if($do == 'Update'){//brace Start of Update page
echo '<div>Hello from update</div>';
?>
<?php } //brace End of Update page

else if($do == 'Delete'){ //brace start of Delete page

echo 'Hello from Delete';
?>

<?php } //brace End of Delete page


else if($do == 'Activate'){ //brace start of Activate page

echo 'Hello from Activate';
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






