<?php
session_start();
include 'config/db.php';

/* 1. CHECK LOGIN */
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['uid'];

/* 2. CHECK PRODUCT ID */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: shop.php");
    exit();
}

$product_id = (int) $_GET['id'];

/* 3. CHECK PRODUCT EXISTS */
$product_check = mysqli_query(
    $conn,
    "SELECT id FROM products WHERE id = $product_id"
);

if (mysqli_num_rows($product_check) == 0) {
    header("Location: shop.php");
    exit();
}

/* 4. CHECK IF PRODUCT ALREADY IN CART */
$cart_check = mysqli_query(
    $conn,
    "SELECT id, quantity FROM cart 
     WHERE user_id = $user_id 
     AND product_id = $product_id"
);

if (mysqli_num_rows($cart_check) > 0) {
    // Increase quantity
    mysqli_query(
        $conn,
        "UPDATE cart 
         SET quantity = quantity + 1 
         WHERE user_id = $user_id 
         AND product_id = $product_id"
    );
} else {
    // Insert new item
    mysqli_query(
        $conn,
        "INSERT INTO cart (user_id, product_id, quantity) 
         VALUES ($user_id, $product_id, 1)"
    );
}

/* 5. REDIRECT TO CART */
header("Location: cart.php");
exit();
?>
