

<?php

include 'connect.php';

$tpl = 'includes/templates/';   //template directory



$css = 'layout/css/';     //css directory

$js = 'layout/js/';    //js directory


$lang = 'includes/languages/';  //languagees directory

$func = 'includes/functions/';  //functions directory





//////////////////////////////////////the important files///////////

include $func .'functions.php';
include $lang .'english.php';
include $tpl .'header.php';

if(!isset($noNavbar)){
    include $tpl .'navbar.php';

}

?>