<?php
session_start();
require '../db.php';
if (isset($_GET['download'])) {
    $id = $_GET['download'];
    $result = mysqli_query($conn,"SELECT * FROM cart where id ='$id'") or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $county=$row['county'];
    $map_name=$row['map_name'];
    $filename="downloads/maps/".$county."/".$map_name;
    $_SESSION['filename']=$filename;
    header('location:maps.php?download_started');
}else{
    header("Location:maps.php");
}
