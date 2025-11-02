<?php 
session_start();
require('includs/users.class.php') ;
require('function.php');

if(!checkLogin())
    exit("you are already logged in, to go to profile , <a href='profile.php'>click here</a>");

if(isset($_POST['submit'])){

    $userObject = new Users();

    $username= $_POST['username'];
    $password= $_POST['password'];
    $email= $_POST['email'];
    $image = ''; 

    if(isset($_FILES['image'])){
        $name= $_FILES['image']['name'];   
        $type=$_FILES['image']['type'];
        $error = $_FILES['image']['error'];
        $tmp= $_FILES['image']['tmp_name'];
        $size=$_FILES['image']['size'];    
        $newname=md5(date('U')).$name; 

        if($type=='image/png' || $type=='image/jpeg' || $type=='image/gif'){
            $image=$newname;
            if(move_uploaded_file($tmp,'uploads/'.$newname)){
                echo 'file uploaded';
            }else{
                echo 'file not uploaded';
            }
        }
    }

    if($userObject->register($username,$password,$email, $image)){
        echo "ok , move to login,<a href='login.php'>click here</a>";
        $user = $userObject->getUserdata();
        $_SESSION['user']=$user;
        echo "to go to profile , <a href='profile.php'>click here</a>";
        exit();
    } else {
        echo 'Write Valid Data';
    }

}
?>

<form method="post" action="register.php" enctype="multipart/form-data">
    username<input type="text" name="username" /><br />
    password<input type="password" name="password" /><br />
    email<input type="text" name="email" /><br />
    image<input type="file" name="image" /><br />
    <input type="submit" name="submit" value="register" /><br />
</form>
