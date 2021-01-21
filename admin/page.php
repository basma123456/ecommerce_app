<?php
$do;

if(isset($_GET['do'])){

$do=$_GET['do'];

}else{
    $do = 'manage';
}

/////////////////////////////////////

if($do=='manage'){

echo 'you are in manage page';
echo '<br><a href="page.php?do=add"> add in the page</a>';

}elseif($do=='add'){
echo 'you are in add page';

}else{
 echo 'Error there is no page with this name'; 
}





?>