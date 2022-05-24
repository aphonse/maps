<?php
session_start();
require 'db.php';
global $conn;
if(isset($_POST['id']) or isset($_POST['checked_id'])) {
    if(isset($_POST['id'])){
        $ward_id=$_POST['id'];
        $result = mysqli_query($conn, "SELECT * FROM maps where id = '$ward_id'") or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        $constituency = $row['constituency'];
        $ward = $row['ward'];
        $map_name=$row['map_name'];
        $county=$row['county'];
        $_SESSION['ward'] = $ward;
        $_SESSION['constituency'] = $constituency;
        if (isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }else{
            $user=$_SESSION['timestamp'];
        }
        $status=0;
//        $sql = "INSERT INTO cart (county,constituency, ward,map_name,user,status) VALUES ('$county','$constituency','$ward','$map_name','$user','0')";
//        $result2 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $stmt = $conn->prepare("INSERT INTO cart (county,constituency, ward,map_name,user,status) VALUES (? ,? ,? ,? ,? ,?)");
        $stmt->bind_param("ssssss", $county, $constituency, $ward,$map_name,$user,$status);
        $stmt->execute();
//        if ($result2){
//            $_SESSION['cart_message']="Map added to cart";
//        }else{
//            $_SESSION['cart_error']="Error adding to cart try again";
//        }
    }
    if(isset($_POST['checked_id'])){
        $county_id=$_POST['checked_id'];
        $result = mysqli_query($conn, "SELECT * FROM counties where id = '$county_id'") or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        $county = $row['name'];
        if (isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }else{
            $user=$_SESSION['timestamp'];
        }
        $result2 = mysqli_query($conn, "SELECT * FROM maps where county = '$county'") or die(mysqli_error($conn));
        while ($row2=mysqli_fetch_array($result2)){
            $constituency = $row2['constituency'];
            $ward = $row2['ward'];
            $map_name=$row2['map_name'];
            $status='0';

            $stmt = $conn->prepare("INSERT INTO cart (county,constituency, ward,map_name,user,status) VALUES (? ,? ,? ,? ,? ,?)");
            $stmt->bind_param("ssssss", $county, $constituency, $ward,$map_name,$user,$status);
            $stmt->execute();

        }
    }

}else{
    header("Location:index.php");
}
?>