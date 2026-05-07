<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

include "header.php";

$user_id = $_SESSION['uid'];

/* Update ONLY this user's orders */
mysqli_query($conn, "UPDATE orders 
                     SET order_status='Pending' 
                     WHERE order_status='Processing' 
                     AND user_id='$user_id'");

/* Fetch Orders */
$sql = "SELECT order_id, order_total, payment_status, order_status, order_date 
        FROM orders 
        WHERE user_id='$user_id' 
        ORDER BY order_date DESC";

$result = mysqli_query($conn, $sql);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}
?>

<style>
.order-container {
    width: 85%;
    margin: 40px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.order-container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}

.order-table {
    width: 100%;
    border-collapse: collapse;
}

.order-table thead {
    background: linear-gradient(90deg, #1b5e20, #2e7d32);
    color: white;
}

.order-table th,
.order-table td {
    padding: 15px;
    text-align: center;
}

.order-table tbody tr {
    border-bottom: 1px solid #eee;
}

.status-badge,
.payment-badge{
    padding:5px 12px;
    border-radius:20px;
    font-weight:bold;
    font-size:12px;
    display:inline-block;
}

/* Order Status Colors */
.status-Pending { background:#fff3cd; color:#856404; }
.status-Confirmed { background:#cce5ff; color:#004085; }
.status-Shipped { background:#d1ecf1; color:#0c5460; }
.status-Delivered { background:#d4edda; color:#155724; }
.status-Cancelled { background:#f8d7da; color:#721c24; }

/* Payment Status Colors */
.payment-Completed { background:#d4edda; color:#155724; }
.payment-Pending { background:#fff3cd; color:#856404; }
.payment-Failed { background:#f8d7da; color:#721c24; }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<div class="order-container">
    <h2>🛒 Order Status</h2>

<?php if(mysqli_num_rows($result) > 0){ ?>

<table class="order-table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Total (₹)</th>
            <th>Payment Status</th>
            <th>Order Status</th>
        </tr>
    </thead>

    <tbody>

<?php while($row = mysqli_fetch_assoc($result)){ 

    $payment_status = trim($row['payment_status']);
    $order_status   = trim($row['order_status']);
?>

<tr>
    <td>#<?php echo $row['order_id']; ?></td>
    <td><?php echo $row['order_date']; ?></td>
    <td>₹<?php echo $row['order_total']; ?></td>

    <td>
        <span class="payment-badge payment-<?php echo $payment_status; ?>">
            <?php echo $payment_status; ?>
        </span>
    </td>

    <td>
        <span class="status-badge status-<?php echo $order_status; ?>">
            <?php echo $order_status; ?>
        </span>
    </td>
</tr>

<?php } ?>

    </tbody>
</table>

<?php } else { ?>

<div class="text-center p-5">
    <h5>You have no orders yet 💔</h5>
    <a href="shop.php" class="move-btn">Start Shopping</a>
</div>

<?php } ?>

</div>

<?php include "footer.php"; ?>