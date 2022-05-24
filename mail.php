<?php
session_start();
// the message
require 'db.php';
global $conn;
$message1="";
if (isset($_GET['paypal'])) {
    $_SESSION['paypal'] = "Thank you for your payment!";
    $user = $_SESSION['contact'];
    $timestamp=$_SESSION['timestamp'];
    $sql = "UPDATE cart SET user ='$user' WHERE user='$timestamp'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $sql = "UPDATE cart SET status='1' WHERE user='$user'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $_SESSION['showAlert'] = 'block';
    $_SESSION['mail_message'] = "Check Email for Transaction code  and enter below";
    header("Location:checkout.php");
}
if (isset($_POST['code']) or isset($_POST['check'])){

    $user=$_SESSION['contact'];
    if(isset($_POST['code'])){
        $code=$_POST['code'];
    }
    if(isset($_POST['check'])){
        $choice=$_POST['check'];
    }

    $timestamp=$_SESSION['timestamp'];

    $sql = "UPDATE cart SET user ='$user' WHERE user='$timestamp'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $stmt = $conn->prepare("SELECT * FROM cart where user ='$user' and status='0'");
    $stmt->execute() or die(mysqli_error($conn));
    $result = $stmt->get_result();

    $count=1;
    $message="";

    while ($row = $result->fetch_assoc()){
        $message1.=$count.". ".$row['county']."- ".$row['ward']."\n";

        $count+=1;
    }
    $msg ="User(Email or Whatsapp): ".$user." requested the following maps \n".
        "".$message1.
        " Payment Method: ".$choice.
        " \nConfirmation Code: ".$code;
    $msg2="Hello this is Alphonse kiprop";

// use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    $sql = "UPDATE cart SET status='1' WHERE user='$user' and status='0'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
// send email
    mail("1450kenya@gmail.com","My subject",$msg);
    $_SESSION['showAlert'] = 'block';
    $_SESSION['mail_message'] = "Order Sent Successfully Check your email in a few hours for the maps";
    header("Location:downloads/maps.php");
    exit();
}else{
    $_SESSION['showAlert'] = 'block';
    $_SESSION['mail_message'] = "Order not Sent";
    header("Location:checkout.php?Error sending mail");
    exit();
}


