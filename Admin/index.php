<?php
session_start();
$noNavbar ='';
$pageTitle="Login";
/*check if the session is exits OR Not
 * if it exits
 direct this user  to his dashboard */
if (isset($_SESSION['Username'])) { header("Location: dashboard.php");
}

include 'init.php';






/** Check if the user get from POST REQUEST(form the form) OR NOT
 *if the user get from POST REQUEST
* *****CHECK if he/she exits in the DATAbase
* *********if he/she in the DATABASES Register the session
 * */
if($_SERVER['REQUEST_METHOD']=="POST"){

//prepare the fields you will search with in the database
    $username=$_POST['user'];
    $password=$_POST['pass'];
    $hashedPass=sha1($password);

        //check if the user exists or not

        $stmt=$con->prepare("SELECT
                                UserID,Username,Password
                            FROM
                            users
                            WHERE
                                Username= ?
                            AND
                                Password= ?
                           AND
                                GroupID=1
                                LIMIT 1");

    $stmt->execute(array($username,$password));
    $row=$stmt->fetch();                                                          //get the result from excuting the statement
    $count=$stmt->rowCount();
if($count > 0){
    $_SESSION['Username']= $username;
    $_SESSION['ID']=$row['UserID'];
    header('Location: dashboard.php');
    exit();
        } else{
            echo "you are not one of the admins";
}

}




?>



<!-- start login form -->
<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center">Login Form</h4>
    <input class="form-control"type="text" name="user" placeholder="UserName" autocomplete="off">
    <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password"/>
    <input class="btn btn-primary btn-block"type="submit" value="Login"/>
</form>
<!-- End login form -->


<?php include $tpl . 'footer.php';?>
