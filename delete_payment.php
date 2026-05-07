<?php
include 'config/db.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('No payment selected'); window.location='admin_payments.php';</script>";
    exit;
}

$payment_id = $_GET['id'];

$sql = "DELETE FROM payments WHERE payment_id = '$payment_id'";
mysqli_query($conn, $sql);

echo "<script>alert('Payment deleted successfully'); window.location='admin_payments.php';</script>";
?>
