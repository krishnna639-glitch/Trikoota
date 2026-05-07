<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    die("Product ID missing");
}

$user_id = $_SESSION['uid'];
$product_id = (int) $_GET['id'];

/* Check product exists */
$checkProduct = mysqli_query($conn,
    "SELECT id FROM products WHERE id = $product_id"
);

if(mysqli_num_rows($checkProduct) == 0){
    die("Product not found");
}

/* Check already in wishlist */
$checkWishlist = mysqli_query($conn,
    "SELECT w_id FROM wishlist 
     WHERE user_id = $user_id 
     AND product_id = $product_id"
);

if(mysqli_num_rows($checkWishlist) == 0){
    $insert = mysqli_query($conn,
        "INSERT INTO wishlist (user_id, product_id)
         VALUES ($user_id, $product_id)"
    );

    if(!$insert){
        die("Insert failed: " . mysqli_error($conn));
    }
}

header("Location: wishlist.php");
exit();
?>
