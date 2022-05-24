<?php
/**
 * Created by PhpStorm.
 * User: Aphonse
 */
session_start();
//REGISTER NEW MEMBERS
if (isset($_POST['register'])) {
    $conn = mysqli_connect("localhost", "id18718070_root", "9R/TjH6Rd=0g|H+W", "id18718070_counties");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordconf = mysqli_real_escape_string($conn, $_POST['passwordrepeat']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    //Check the passwords
    if (!($password==$passwordconf)){
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = "Passwords don't match!";
        header("Location:register.php?Signup=Passwords dont match");
        exit();
    }else{
        //check whether email has already been used
        $sql= "SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)>0) {
            $_SESSION['showAlert'] = 'block';
            $_SESSION['message'] = "Email already used!";
            header("Location:register.php?Signup=Email already used");
            exit();
        }else{
            //hash password
            $hashedpwd=password_hash($password,PASSWORD_DEFAULT);
            $status=0;
            $stmt = $conn->prepare('INSERT INTO users (name,email,phone,password,status)VALUES(?,?,?,?,?)');
            $stmt->bind_param('sssss',$name,$email,$phone,$hashedpwd,$status);
            $stmt->execute();
            $affected=mysqli_affected_rows($conn);
            if (!$affected){
                $_SESSION['showAlert'] = 'block';
                $_SESSION['message'] = "Signup was unsuccessful";
                header("Location:register.php?Signup=Unsuccessful");
                exit();
            }else{
                $message="Click the following link to activate your account\n"
                    ."<a href='https://geolight.000webhostapp.com/maps/users/email_verification.php?activation='.$email>Activate Email</a>"
                    ."https://geolight.000webhostapp.com/maps/users/email_verification.php?activation=".$email;
                $_SESSION['showAlert'] = 'block';
                $_SESSION['message'] = "A link has been sent to your email for confirmation";
                $msg = wordwrap($message,70);
                mail($email,"My subject",$msg);

                header("Location:register.php?Signup=Success");
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
