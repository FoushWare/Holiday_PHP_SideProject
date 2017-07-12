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


?>
