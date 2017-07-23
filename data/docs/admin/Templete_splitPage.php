<?php
session_start();
$pageTitle='Categories';
if($_SESSION['Username']){

    include 'init.php';

$do=isset($_GET['do'])?$_GET['do']:"Manage";


if($do=='Manage'){

echo"hello form ".$do;


?>









<?php
}//End brace of Manage

else if($do=="Add"){


echo"hello form ".$do;

?>


<?php
}//End brace of add

else if($do=="Insert"){


echo"hello form ".$do;
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
