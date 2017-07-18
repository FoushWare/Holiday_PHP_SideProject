<?php

//first function to get the title of the page and set i to the page

function SetTitle(){
    global $pageTitle;

$pageTitle=isset($pageTitle)?$pageTitle:'Default';

 }


/*Redirect user to specific location after some action
 *
 * action like[Error ,finishing task]
 *
 *
 * */

function redirectHome($theMsg,$url=null,$seconds =3){

    if($url == null){
        $url='index.php';
        $link='HOME Page';
    }

    if( isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=''  ){

        $url=$_SERVER['HTTP_REFERER'];
        $link='Previous Page';
}else{
        $url="index.php";
        $link='HOME Page';

}

echo $theMsg;

echo '<div class="alert alert-info"> You will be Redirected to '. $link.' after '. $seconds.'  seconds</div>';

header("refresh:$seconds,url=$url");

}//End of redirectHome function


/**checkItem function
 *To check  item in the db i.e(if i want to delete user i  have first check)
 *if he exists in db first and then do action
 * and i.e(in add i have to check if the user exists before add them )
 * avoid dublication
 * */

function checkItem($Item,$from,$value){
        global $con;

    $stmt= $con->prepare("SELECT $Item FROM $from WHERE $Item= ?");
    $stmt->execute(array($value));

    return $stmt->rowCount();


}


/*function to calculate items in the database
 *
 *
 *
 *
 * */

function countItems($item,$table){
    global $con;

    $stmt= $con->prepare("SELECT COUNT($item) FROM $table ");
    $stmt->execute();

    return $stmt->fetchColumn();

}


/*get latest[user,items,....]*/

function getLatest($select,$table,$order,$limit=5){

    global $con;

    $stmt=$con->prepare("SELECT $select FROM $table
                                        ORDER BY $order
                                        DESC LIMIT $limit");
    $stmt->execute();
    $rows=$stmt->fetchAll();
    return $rows;
}












?>
