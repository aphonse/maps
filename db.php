<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
$servername='localhost';
$username='root';
$password='adm10722';
$dbname = "counties";
$conn= mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die('Could not Connect MySql Server:' .mysqli_error());
}
?>