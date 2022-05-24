<?php
session_start();
if (isset($_POST['search_order'])){
    $user=$_POST['search_order'];
    $_SESSION['contact']=$user;
    header("Location:maps.php");
}else{
    header("Location:maps.php");
}