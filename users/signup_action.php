<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 */
$conn = mysqli_connect("localhost", "root", "adm10722", "counties");
session_start();
//REGISTER NEW MEMBERS
if (isset($_POST['register'])) {
    $conn = mysqli_connect("localhost", "root", "adm10722", "counties");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordconf = mysqli_real_escape_string($conn, $_POST['passwordrepeat']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    //Check the passwords
    if (!($password==$passwordconf)){
        $_SESSION['passworderror']="Passwords don't match!";
        header("Location:register.php?Signup=Passwords dont match");
        exit();
    }else{
        //check whether email has already been used
        $sql= "SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)>0) {
            $_SESSION['emailerror']="Email already used!";
            header("Location:register.php?Signup=Email already used");
            exit();
        }else{
            //hash password
            $hashedpwd=password_hash($password,PASSWORD_DEFAULT);
            $stmt = $conn->prepare('INSERT INTO users (name,email,phone,password)VALUES(?,?,?,?)');
            $stmt->bind_param('ssss',$name,$email,$phone,$hashedpwd);
            $stmt->execute();
            $affected=mysqli_affected_rows($conn);
            if (!$affected){
                $_SESSION['signuperror']="Signup was unsuccessful";
                header("Location:register.php?Signup=Unsuccessful");
                exit();
            }else{

                header("Location:../index.php?Signup=Success");
                exit();
            }

        }
    }
} else {
    header("Location:register.php?ERRRROOOORRR!!");
    exit();
}
//LOGIN EXISTING USERS

?>
