<?php
include "config/db.php";
include "admin_header.php";

$filter = $_GET['filter'] ?? 'all';

/* FILTER CONDITIONS */

if($filter == "today"){
    $sql = "SELECT p.*, o.payment_status, o.order_total, u.U_name
            FROM payments p
            JOIN orders o ON p.order_id=o.order_id
            JOIN userr u ON o.user_id=u.U_id
            WHERE DATE(p.payment_date)=CURDATE()";

}elseif($filter == "week"){
    $sql = "SELECT p.*, o.payment_status, o.order_total, u.U_name
            FROM payments p
            JOIN orders o ON p.order_id=o.order_id
            JOIN userr u ON o.user_id=u.U_id
            WHERE YEARWEEK(p.payment_date,1)=YEARWEEK(CURDATE(),1)";

}elseif($filter == "month"){
    $sql = "SELECT p.*, o.payment_status, o.order_total, u.U_name
            FROM payments p
            JOIN orders o ON p.order_id=o.order_id
            JOIN userr u ON o.user_id=u.U_id
            WHERE MONTH(p.payment_date)=MONTH(CURDATE())
            AND YEAR(p.payment_date)=YEAR(CURDATE())";

}elseif($filter == "paid"){
    $sql = "SELECT p.*, o.payment_status, o.order_total, u.U_name
            FROM payments p
            JOIN orders o ON p.order_id=o.order_id
            JOIN userr u ON o.user_id=u.U_id
            WHERE o.payment_status='Paid'";

}elseif($filter == "pending"){
    $sql = "SELECT p.*, o.payment_status, o.order_total, u.U_name
            FROM payments p
            JOIN orders o ON p.order_id=o.order_id
            JOIN userr u ON o.user_id=u.U_id
            WHERE o.payment_status='Pending'";

}elseif($filter == "failed"){
    $sql = "SELECT p.*, o.payment_status, o.order_total, u.U_name
            FROM payments p
            JOIN orders o ON p.order_id=o.order_id
            JOIN userr u ON o.user_id=u.U_id
            WHERE o.payment_status='Failed'";

}else{
    $sql = "SELECT p.*, o.payment_status, o.order_total, u.U_name
            FROM payments p
            JOIN orders o ON p.order_id=o.order_id
            JOIN userr u ON o.user_id=u.U_id";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Reports</title>

<style>
button{
    background:#0d6efd;
    color:white;
    padding:10px 20px;
    margin:10px 5px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#084298;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th,td{
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}

th{
    background:#f2f2f2;
}

.status-paid{color:green;font-weight:bold;}
.status-pending{color:orange;font-weight:bold;}
.status-failed{color:red;font-weight:bold;}
</style>

</head>

<body>

<h2>Payment Reports</h2>

<form method="GET">
    <button name="filter" value="today">Today</button>
    <button name="filter" value="week">This Week</button>
    <button name="filter" value="month">This Month</button>

    <button name="filter" value="paid">Paid</button>
    <button name="filter" value="pending">Pending</button>
    <button name="filter" value="failed">Failed</button>

    <button name="filter" value="all">All Payments</button>
</form>

<table>

<tr>
    <th>#</th>
    <th>User</th>
    <th>Order ID</th>
    <th>Total</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?= $row['payment_id']; ?></td>
    <td><?= $row['U_name']; ?></td>
    <td><?= $row['order_id']; ?></td>
    <td>₹<?= $row['order_total']; ?></td>

    <td class="status-<?= strtolower($row['payment_status']); ?>">
        <?= $row['payment_status']; ?>
    </td>

    <td><?= $row['payment_date']; ?></td>
</tr>

<?php } ?>

</table>
<?php include 'admin_footer.php'; ?>
</body>
</html>
