<?php
include 'header.php';
include 'config/db.php';

if(!isset($_GET['id'])){
    echo "<script>alert('No order selected');window.location='admin_orders.php';</script>";
    exit;
}

$order_id = $_GET['id'];

$order_sql = "SELECT orders.*, userr.U_name, userr.U_email
              FROM orders
              LEFT JOIN userr ON orders.user_id = userr.U_id
              WHERE orders.order_id='$order_id'";

$order_res = mysqli_query($conn,$order_sql);
$order = mysqli_fetch_assoc($order_res);

$product_sql = "SELECT order_items.*, products.name 
                FROM order_items
                LEFT JOIN products ON order_items.product_id = products.id
                WHERE order_items.order_id='$order_id'";

$product_res = mysqli_query($conn,$product_sql);
?>

<style>

.order-container{
    max-width:850px;
    margin:50px auto;
    background:#fff;
    padding:30px 40px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.order-container h2{
    text-align:center;
    color:#2e7d32;
    margin-bottom:20px;
}

.section-title{
    font-weight:bold;
    margin-top:20px;
    color:#444;
}

.info-table, .product-table{
    width:100%;
    margin-top:10px;
}

.info-table th{
    text-align:left;
    padding:8px 0;
    width:150px;
}

.info-table td{
    font-weight:bold;
}

.product-table{
    border-collapse:collapse;
    margin-top:15px;
}

.product-table th{
    background:#f2f2f2;
    padding:10px;
}

.product-table td{
    padding:10px;
    text-align:center;
}

.product-table tr{
    border-bottom:1px solid #eee;
}

.status{
    padding:8px 12px;
    border-radius:6px;
    color:black;
}

.Cancelled{background:red;}
.Pending{background:orange;}
.Completed{background:green;}

.back-btn{
    display:inline-block;
    margin-top:25px;
    padding:10px 20px;
    background:#2e7d32;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

.back-btn:hover{
    background:#1b5e20;
}

</style>

<div class="order-container">

<h2>Order Details</h2>

<div class="section-title">User Info</div>

<table class="info-table">
<tr><th>Username</th><td><?= $order['U_name']; ?></td></tr>
<tr><th>Email</th><td><?= $order['U_email']; ?></td></tr>
<tr>
<th>Status</th>
<td><span class="status <?= $order['order_status']; ?>"><?= $order['order_status']; ?></span></td>
</tr>
<tr><th>Total</th><td>₹<?= $order['order_total']; ?></td></tr>
<tr><th>Date</th><td><?= $order['order_date']; ?></td></tr>
</table>

<div class="section-title">Products</div>

<table class="product-table">
<tr>
<th>#</th>
<th>Product</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
</tr>

<?php $i=1; while($row=mysqli_fetch_assoc($product_res)){ ?>

<tr>
<td><?= $i++; ?></td>
<td><?= $row['name']; ?></td>
<td><?= $row['quantity']; ?></td>
<td>₹<?= $row['price']; ?></td>
<td>₹<?= $row['price']*$row['quantity']; ?></td>
</tr>

<?php } ?>

</table>

<a href="admin_orders.php" class="back-btn">← Back</a>

</div>

<?php include 'footer.php'; ?>
