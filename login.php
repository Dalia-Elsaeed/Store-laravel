<?php 
session_start();
require('includs/users.class.php') ;
require('function.php');
if(checkLogin())
    exit("you are already logged in, to go to profile , <a href='profile.php'>click here</a>");
if(isset($_POST['login'])){

$userObject = new Users();
$username= $_POST['username'];
$password= $_POST['password'];
if($userObject->login($username,$password)){
$user = $userObject->getUserdata();
$_SESSION['user']=$user;
echo "to go to profile , <a href='profile.php'>click here</a>";
exit();

}
else{
echo 'Write Valid Data';
}}

?>
<form method="post" action="">
    username<input type="text" name="username" /><br />
    password<input type="password" name="password" /><br />
    <input type="submit" name="login" value="Login" /><br />
</form>