<?php
session_start();
require('function.php');
if(!checkLogin())
    exit("you are not logged in, to login , <a href='login.php'>click here</a>");
$user = $_SESSION['user'];
echo "<img width='500' height='500' src='uploads/".$user['image']."'>";
echo"<br>";
echo "name: ".$user['username']."<br>";
echo "email: ".$user['email']."<br>";
echo"<a href='edit.php'>Edit Profile</a>.<br>";
echo"<a href='logout.php'>Logout</a>";