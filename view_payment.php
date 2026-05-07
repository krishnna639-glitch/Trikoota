<?php
include 'header.php';
include 'config/db.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('No payment selected'); window.location='admin_payments.php';</script>";
    exit;
}

$payment_id = $_GET['id'];

$sql = "SELECT payments.*, userr.U_name, userr.U_email, orders.order_total 
        FROM payments
        LEFT JOIN userr ON payments.user_id = userr.U_id
        LEFT JOIN orders ON payments.order_id = orders.order_id
        WHERE payments.payment_id = '$payment_id'";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>

<style>

.payment-container{
    max-width:650px;
    margin:50px auto;
    background:#fff;
    padding:30px 40px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.payment-container h2{
    text-align:center;
    color:#2e7d32;
    margin-bottom:25px;
}

.payment-table{
    width:100%;
}

.payment-table tr{
    border-bottom:1px solid #eee;
}

.payment-table th{
    padding:12px 0;
    color:#555;
    text-align:left;
}

.payment-table td{
    padding:12px 0;
    font-weight:bold;
}

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

.status{
    padding:4px 10px;
    border-radius:5px;
}

.Pending{background:orange;color:white;}
.Paid{background:green;color:white;}

</style>

<div class="payment-container">

<h2>Payment Details</h2>

<table class="payment-table">

<tr><th>Payment ID</th><td><?= $data['payment_id']; ?></td></tr>

<tr><th>User</th><td><?= $data['U_name']; ?></td></tr>

<tr><th>Email</th><td><?= $data['U_email']; ?></td></tr>

<tr><th>Order ID</th><td><?= $data['order_id']; ?></td></tr>

<tr><th>Order Total</th><td>₹<?= $data['order_total']; ?></td></tr>

<tr><th>Amount Paid</th><td>₹<?= $data['amount']; ?></td></tr>

<tr><th>Payment Method</th><td><?= $data['payment_method']; ?></td></tr>

<tr><th>Status</th>
<td>
<span class="status <?= $data['payment_status']; ?>">
<?= $data['payment_status']; ?>
</span>
</td>
</tr>

<tr><th>Date</th><td><?= $data['payment_date']; ?></td></tr>

</table>

<a href="admin_payments.php" class="back-btn">← Back</a>

</div>

<?php include 'footer.php'; ?>
