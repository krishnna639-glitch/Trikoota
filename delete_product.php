<?php
session_start();
include "config/db.php";

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

// Check if product ID is passed
if(!isset($_GET['id'])){
    header("Location: admin_products.php");
    exit();
}

$product_id = intval($_GET['id']);

// Fetch the product first to get image file name
$sql = "SELECT image FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $product = mysqli_fetch_assoc($result);
    $image_file = $product['image'];

    // Delete the image from uploads folder
    if(file_exists("uploads/".$image_file)){
        unlink("uploads/".$image_file);
    }

    // Delete product from database
    $delete_sql = "DELETE FROM products WHERE id = $product_id";
    if(mysqli_query($conn, $delete_sql)){
        echo "<script>alert('Product deleted successfully'); window.location='admin_products.php';</script>";
    } else {
        echo "Error deleting product: ".mysqli_error($conn);
    }

} else {
    echo "<script>alert('Product not found'); window.location='admin_products.php';</script>";
}
?>
