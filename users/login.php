<?php
require '../db.php';
global $conn;
if ($_POST['login']) {
    session_start();
    $email = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql="SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    $retval=mysqli_fetch_array($result);
    if (!$retval){
        $_SESSION['message'] = "Invalid Username or password";
        header("Location:register.php?Invalid Username or password");
        exit();
    }else{
        //de-hash the password
        $verifypwd=password_verify($password,$retval['password']);
        if ($verifypwd== false){
            $_SESSION['message'] = "Invalid Username or password";
            header("Location:register.php?Passwords don't match");
            exit();
        }else{
            $_SESSION['user']=$retval['email'];
            $_SESSION['name']=$retval['name'];
            header("Location:../index.php?Login Success");
            exit();
        }
    }
}else{
    header("Location:register.php?Login=empty");
    exit();
}
