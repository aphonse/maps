<?php
if(!isset($_SESSION))
{
    session_start();
}
require 'db.php';
global $conn;
if (isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    $user=$_SESSION['timestamp'];
}
// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $conn->prepare("SELECT * FROM cart where user ='$user' AND status='0'") or die(mysqli_error($conn));
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE id=? AND user ='$user' and status='0'");
    $stmt->bind_param('i',$id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
    $stmt = $conn->prepare("DELETE FROM cart WHERE user =? AND status='0'");
    $stmt->bind_param('s',$user);
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Items removed from the cart!';
    header('location:cart.php');
}

?>