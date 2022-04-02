<?php
session_start();
if ($_SESSION['user']){
    session_destroy();
    header("Location:register.php?logged out");
    exit();
}else{
    header("Location:register.php");
}