<?php
session_start();
include 'config/db.php';
include 'header.php';

/* CHECK LOGIN */
if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['order_id'])){
    header("Location: my_orders.php");
    exit();
}

$order_id = (int)$_GET['order_id'];
$user_id  = (int)$_SESSION['uid'];

/* VERIFY ORDER OWNERSHIP */
$order_q = mysqli_query($conn,
    "SELECT * FROM orders 
     WHERE order_id = $order_id 
     AND user_id = $user_id"
);

if(mysqli_num_rows($order_q) == 0){
    die("Unauthorized access");
}

$order = mysqli_fetch_assoc($order_q);

/* FETCH ORDER ITEMS */
$items = mysqli_query($conn,
    "SELECT 
        oi.quantity,
        oi.price,
        oi.deal_name,
        p.name,
        p.image
     FROM order_items oi
     JOIN products p ON oi.product_id = p.id
     WHERE oi.order_id = $order_id"
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f3;
}
.container{
    max-width:900px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}
h2{
    text-align:center;
    color:#2e7d32;
    margin-bottom:20px;
}
.order-info{
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
    font-size:16px;
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#2e7d32;
    color:white;
    padding:12px;
}
td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
.product-img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:10px;
}
.total{
    text-align:right;
    margin-top:20px;
    font-size:20px;
    font-weight:bold;
}
.back-btn{
    display:inline-block;
    margin-top:25px;
    padding:10px 20px;
    background:#2e7d32;
    color:white;
    text-decoration:none;
    border-radius:8px;
}
.back-btn:hover{
    background:#1b5e20;
}
</style>
</head>

<body>

<div class="container">
    <h2>🧾 Order Details</h2>

    <div class="order-info">
        <div>
            <p><strong>Order ID:</strong> #<?php echo $order['order_id']; ?></p>
            <p><strong>Order Date:</strong> <?php echo date('d M Y', strtotime($order['order_date'])); ?></p>
        </div>
        <div>
            <p><strong>Status:</strong> <?php echo $order['order_status']; ?></p>
            <p><strong>Payment:</strong> <?php echo $order['payment_status']; ?></p>
        </div>
    </div>

    <table>
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price (₹)</th>
            <th>Qty</th>
            <th>Total (₹)</th>
        </tr>

        <?php 
        $grand_total = 0;
        while($row = mysqli_fetch_assoc($items)){
            $line_total = $row['price'] * $row['quantity'];
            $grand_total += $line_total;
        ?>
        <tr>
            <td><img src="uploads/<?php echo $row['image']; ?>" class="product-img"></td>
            <td>
				<?php echo htmlspecialchars($row['name']); ?>

				<?php if (!empty($row['deal_name'])): ?>
				<div style="margin-top:5px;font-size:12px;color:#d32f2f;">
					🎉 Deal Applied: <strong><?php echo htmlspecialchars($row['deal_name']); ?></strong>
				</div>
				<?php endif; ?>
			</td>

            <td>
				₹<?php echo number_format($row['price'],2); ?>
				<?php if (!empty($row['deal_name'])): ?>
				<div style="font-size:11px;color:green;">Deal Price</div>
				<?php endif; ?>
			</td>

            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo number_format($line_total,2); ?></td>
        </tr>
        <?php } ?>
    </table>

    <div class="total">
        Grand Total: ₹<?php echo number_format($grand_total,2); ?>
    </div>

    <a href="my_orders.php" class="back-btn">← Back to Orders</a>
</div>

</body>
</html>
