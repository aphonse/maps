<?php
session_start();
require 'db.php';
global $conn;
if(isset($_POST['id'])) {
    $ward_id = $_POST['id'];
    $result = mysqli_query($conn, "SELECT * FROM maps where id = '$ward_id'") or die(mysqli_error($conn));

    $row = mysqli_fetch_array($result);
    $constituency = $row['constituency'];
    $ward = $row['ward'];
    $map_name=$row['map_name'];
    $county=$row['county'];
    $_SESSION['ward'] = $ward;
    $_SESSION['constituency'] = $constituency;

    $user = $_SESSION['user'];
    $sql = "INSERT INTO cart (county,constituency, ward,map_name,user,status) VALUES ('$county','$constituency','$ward','$map_name','$user','0')";
    $result2 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($result2){
        $_SESSION['cart_message']="Map added to cart";
    }else{
        $_SESSION['cart_error']="Error adding to cart try again";
    }
}else{
    header("Location:index.php");
}
?>