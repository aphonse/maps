<?php
require '../db.php';
global $conn;
if ($_GET['activation']){
    $user=$_GET['activation'];
    $sql = "UPDATE users SET status='1' WHERE user='$user'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}else{
    header("Location:index.php?254");
}
