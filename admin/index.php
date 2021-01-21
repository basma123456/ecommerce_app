

<?php

session_start();

$noNavbar = '';
$pageTitle='Login';

if(isset($_SESSION['userSession'])){
header('Location:dashboard.php');
}


include 'init.php';







if ($_SERVER['REQUEST_METHOD'] =='POST') {



$user_name = $_POST['user'];
$password = $_POST['pass'];
$hashedpass = sha1($password);



$stmt = $con->prepare("SELECT 
                      user_name, password, user_id 
                      FROM 
                      users 
                      WHERE user_name = ? 
                      AND 
                      password = ? 
                      AND 
                      group_id =1
                      
                      LIMIT 1");

$stmt ->execute(array($user_name, $hashedpass));
$row = $stmt->fetch();
$count = $stmt->rowCount();
if($count>0){
$_SESSION['userId'] = $row['user_id'];
$_SESSION['userSession'] = $user_name;  //register session and aquire it a value which is the $user_name

header('Location:dashboard.php'); 



exit();


}else{
    echo $count;

}

}


/*if($count > 0) {

$_SESSION['username'] = $user_name;  // register session


header('Location:dashboard.php');
exit();



}*/





   
?>



<!-- /////////////////////////////////////////////////////////////////-->








<form class="login" action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="POST">


<h4 class="text-center">admin login</h4>

<input class="form-control" type="text" name="user" placeholder="user_name" autocomplete="off" />

<input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new-password" />

<input class="btn btn-primary btn-block bbtn" type="submit" value="login" />









</form>












<?php




include $tpl . 'footer.php';



?>

