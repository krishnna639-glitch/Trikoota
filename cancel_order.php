<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

$order_id = intval($_GET['id']);
$user_id = $_SESSION['uid'];

mysqli_query($conn,"
UPDATE orders 
SET order_status='Cancelled',
    cancelled_by='user'
WHERE order_id=$order_id AND user_id=$user_id
");

header("Location: my_orders.php");
exit();
