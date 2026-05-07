<?php
session_start();
include 'config/db.php';
include "header.php";

if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['order_id'])){
    header("Location: shop.php");
    exit();
}

$order_id = (int)$_GET['order_id'];
$user_id  = (int)$_SESSION['uid'];

/* Fetch order */
$order = mysqli_query($conn,
    "SELECT * FROM orders 
     WHERE order_id = $order_id 
     AND user_id = $user_id"
);

if(mysqli_num_rows($order) == 0){
    die("Invalid order");
}

$order = mysqli_fetch_assoc($order);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Successful</title>
<style>
body{
    background:#f1f8e9;
    font-family: Arial, sans-serif;
}
.container{
    max-width:600px;
    margin:80px auto;
    background:white;
    padding:40px;
    text-align:center;
    border-radius:20px;
    box-shadow:0 15px 30px rgba(0,0,0,0.15);
}
.check{
    font-size:70px;
    color:#2e7d32;
}
h2{
    color:#2e7d32;
    margin-top:15px;
}
.order-info{
    margin:25px 0;
    font-size:18px;
}
.btn{
    display:inline-block;
    margin:10px;
    padding:12px 25px;
    background:#2e7d32;
    color:white;
    border-radius:8px;
    text-decoration:none;
    transition:.3s;
}
.btn:hover{
    background:#1b5e20;
}
</style>
</head>

<body>

<div class="container">
    <div class="check">✔</div>
    <h2>Order Placed Successfully!</h2>
    <p>Thank you for shopping with us 🌱</p>

    <div class="order-info">
        <p><strong>Order ID:</strong> #<?php echo $order['order_id']; ?></p>
        <p><strong>Total Amount:</strong> ₹<?php echo number_format($order['order_total'],2); ?></p>
        <p><strong>Payment Method:</strong> Cash on Delivery</p>
        <p><strong>Order Status:</strong> <?php echo $order['order_status']; ?></p>
    </div>

    <a href="my_orders.php" class="btn">My Orders</a>
    <a href="product.php" class="btn">Continue Shopping</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
