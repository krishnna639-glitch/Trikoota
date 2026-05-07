<?php
session_start();
include 'config/db.php';
include 'admin_header.php';

/* CHECK ADMIN LOGIN */
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: admin_orders.php");
    exit();
}

$order_id = (int)$_GET['id'];

/* FETCH ORDER */
$order_q = mysqli_query($conn,
    "SELECT o.*, u.U_name, u.U_email 
     FROM orders o
     JOIN userr u ON o.user_id = u.U_id
     WHERE o.order_id = $order_id"
);

if(mysqli_num_rows($order_q) == 0){
    die("Order not found");
}

$order = mysqli_fetch_assoc($order_q);

$old_status = $order['order_status'];


if(isset($_POST['update'])){

$new_status = mysqli_real_escape_string($conn,$_POST['order_status']);
$payment_status = mysqli_real_escape_string($conn,$_POST['payment_status']);

$cancelled_by = ($new_status=='Cancelled') ? 'admin' : NULL;

/* UPDATE ORDER */
mysqli_query($conn,"
UPDATE orders SET 
order_status='$new_status',
payment_status='$payment_status',
cancelled_by='$cancelled_by'
WHERE order_id=$order_id
");

// 2. NEW: Update the 'payments' table to keep it in sync
    mysqli_query($conn, "
        UPDATE payments 
        SET payment_status = '$payment_status' 
        WHERE order_id = $order_id
    ");

/* RESTORE STOCK WHEN CANCELLED */
if($new_status == 'Cancelled'){

$items = mysqli_query($conn,"
SELECT product_id, quantity FROM order_items WHERE order_id=$order_id
");

while($item=mysqli_fetch_assoc($items)){

$pid=$item['product_id'];
$qty=$item['quantity'];

mysqli_query($conn,"
UPDATE products SET stock_quantity = stock_quantity + $qty
WHERE id=$pid
");

}
}

header("Location: admin_orders.php?updated=1");
exit();
}



if(isset($_POST['update'])){

    $new_status = mysqli_real_escape_string($conn, $_POST['order_status']);
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);

    // Update order
    mysqli_query($conn,
        "UPDATE orders 
         SET order_status='$new_status',
            payment_status='$payment_status',
            cancelled_by = IF('$new_status'='Cancelled','admin',cancelled_by)
          WHERE order_id=$order_id"
    );

    // 2. NEW: Update the 'payments' table to keep it in sync
    mysqli_query($conn, "
        UPDATE payments 
        SET payment_status = '$payment_status' 
        WHERE order_id = $order_id
    ");

    /* =============================
       RESTORE STOCK WHEN CANCELLED
       ============================= */

    if($old_status == 'Delivered' && $new_status == 'Cancelled'){

        $items = mysqli_query($conn,
            "SELECT product_id, quantity 
             FROM order_items 
             WHERE order_id = $order_id"
        );

        while($item = mysqli_fetch_assoc($items)){
            $pid = $item['product_id'];
            $qty = $item['quantity'];

            mysqli_query($conn,
                "UPDATE products 
                 SET quantity = quantity + $qty 
                 WHERE product_id = $pid"
            );
        }
    }

    header("Location: admin_orders.php?updated=1");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Order Status</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#eef3ec;
}
.container{
    max-width:600px;
    margin:60px auto;
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
.info p{
    font-size:16px;
    margin:6px 0;
}
label{
    font-weight:bold;
    margin-top:15px;
    display:block;
}
select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:6px;
    border:1px solid #ccc;
}
button{
    width:100%;
    margin-top:25px;
    padding:12px;
    background:#2e7d32;
    border:none;
    color:white;
    font-size:16px;
    border-radius:8px;
    cursor:pointer;
}
button:hover{
    background:#1b5e20;
}
.back{
    display:block;
    margin-top:15px;
    text-align:center;
    text-decoration:none;
    color:#2e7d32;
}
</style>
</head>

<body>

<div class="container">
    <h2>🛠 Update Order</h2>

    <div class="info">
        <p><strong>Order ID:</strong> #<?php echo $order['order_id']; ?></p>
        <p><strong>User:</strong> <?php echo $order['U_name']; ?> (<?php echo $order['U_email']; ?>)</p>
        <p><strong>Total:</strong> ₹<?php echo number_format($order['order_total'],2); ?></p>
    </div>

    <form method="POST">
        <label>Order Status</label>
        <select name="order_status" required>
            <?php
            $statuses = ['Pending','Processing','Shipped','Delivered','Cancelled'];
            foreach($statuses as $s){
                $selected = ($order['order_status'] == $s) ? 'selected' : '';
                echo "<option value='$s' $selected>$s</option>";
            }
            ?>
        </select>

        <label>Payment Status</label>
        <select name="payment_status" required>
            <?php
            $payments = ['Pending','Paid','Failed'];
            foreach($payments as $p){
                $selected = ($order['payment_status'] == $p) ? 'selected' : '';
                echo "<option value='$p' $selected>$p</option>";
            }
            ?>
        </select>

        <button type="submit" name="update">Update Order</button>
    </form>

    <a href="admin_orders.php" class="back">← Back to Orders</a>
</div>

</body>
</html>