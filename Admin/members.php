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
if($do== 'Edit'){ //brace stat of Edit page
?>

<div class="container">
<form class="form-horizontal">
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


<?php } //brace End of Edit page


else if($do == 'Add'){ //brace start of Add page
?>


<?php } //brace End of Add page


else if($do == 'Mange'){//brace start of Manage page

?>

<?php } //brace End of Manage page


else if($do == 'Insert'){ //brace Start of Insert page


?>

<?php } //brace End of Insert page

else if($do == 'Update'){//brace Start of Update page

?>
<?php } //brace End of Update page

else if($do == 'Delete'){ //brace start of Delete page
?>

<?php } //brace End of Delete page


else if($do == 'Activate'){ //brace start of Activate page
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






