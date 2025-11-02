<?php 
session_start();
require('includs/users.class.php') ;
require('function.php');
if(!checkLogin())
    exit("you are not logged in, to login , <a href='login.php'>click here</a>");
$user = $_SESSION['user'];
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

        if($error==0 && ($type=='image/png' || $type=='image/jpeg' || $type=='image/gif')){
            $image=$newname;
            if(move_uploaded_file($tmp,'uploads/'.$newname)){
                echo 'file uploaded';
            }else{
                echo 'file not uploaded';
            }
        }
    }

    if($userObject->edit($user['id'],$username,$password,$email, $image)){
        echo "ok , move to login,<a href='login.php'>click here</a>";
        $user = $userObject->getUserdata();
        $_SESSION['user']=$user;
        echo "data updated successfully,go to profile , <a href='profile.php'>click here</a>";
     $_SESSION['user']=$userObject->getUser($user["id"]);
     
        exit();
    } else {
        echo 'Write Valid Data';
    }

}
?>

<form method="post" action="edit.php" enctype="multipart/form-data">
    username<input type="text" name="username" value="<?php echo $user['username']; ?>"/><br />
    password<input type="password" name="password" /><br />
    email<input type="text" name="email" value="<?php echo $user['email']; ?>"/><br />
    image<input type="file" name="image" /><br />
    <input type="submit" name="submit" value="edit" /><br />
</form>
