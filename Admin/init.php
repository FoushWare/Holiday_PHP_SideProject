<?php

include 'connect.php';


/* Routes */
$tpl    ="includes/templates/";
$lang   ="includes/languages/";
$func   ="includes/functions/";
$libs   ="includes/libraries/";
$CSS    ="layout/CSS/";
$JS     ="layout/js/";
$font   ="layout/fonts";

//include important files
include $tpl . 'header.php';

//include navbar in all pages except the page with variable $noNavbar
if(!isset($noNavbar)){ include $tpl . 'navbar.php'; }
?>
