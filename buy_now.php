<?php
session_start();

if(!isset($_SESSION['uid']))
{
    echo "<script>
            alert('Please login first');
            window.location.href='login.php';
          </script>";
    exit();
}
include 'config/db.php';


$user_id = $_SESSION['uid'];
$product_id = $_GET['id'];

// clear old cart (optional)
mysqli_query($conn,"DELETE FROM cart WHERE user_id=$user_id");

// insert product into cart
mysqli_query($conn,"
INSERT INTO cart (user_id, product_id, quantity)
VALUES ($user_id, $product_id, 1)
");

// go checkout
header("Location: checkout.php");
exit();
?>