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
    header("Location: admin_payment.php");
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

/* UPDATE PAYMENT STATUS ONLY */
if(isset($_POST['update'])){

    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);

    // UPDATE ORDERS TABLE
    mysqli_query($conn,
        "UPDATE orders 
         SET payment_status='$payment_status'
         WHERE order_id='$order_id'"
    );

    // UPDATE PAYMENTS TABLE ALSO
    mysqli_query($conn,
        "UPDATE payments 
         SET payment_status='$payment_status'
         WHERE order_id='$order_id'"
    );

    // IF PAYMENT FAILED → CANCEL ORDER BY ADMIN
    if($payment_status == 'Failed'){

        mysqli_query($conn,"
        UPDATE orders 
        SET order_status='Cancelled',
            cancelled_by='admin'
        WHERE order_id='$order_id'
        ");
    }


    header("Location: admin_payments.php?payment_updated=1");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Update Payment Status</title>

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

<h2>🛠 Update Payment</h2>

<div class="info">
    <p><strong>Order ID:</strong> #<?php echo $order['order_id']; ?></p>
    <p><strong>User:</strong> <?php echo $order['U_name']; ?> (<?php echo $order['U_email']; ?>)</p>
    <p><strong>Total:</strong> ₹<?php echo number_format($order['order_total'],2); ?></p>
</div>

<form method="POST" action="">

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

<button type="submit" name="update">Update Payment</button>

</form>

<a href="admin_payments.php" class="back">← Back to Payments</a>

</div>

</body>
</html>
