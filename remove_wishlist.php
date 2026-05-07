<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    die("Wishlist ID missing");
}

$wishlist_id = (int)$_GET['id'];
$user_id = $_SESSION['uid'];

/* Delete item */
mysqli_query($conn,
    "DELETE FROM wishlist 
     WHERE w_id = $wishlist_id 
     AND user_id = $user_id"
);

header("Location: wishlist.php");
exit();
?>
