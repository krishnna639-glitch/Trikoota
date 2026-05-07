<?php
include "config/db.php";
include 'admin_header.php';

// Default filter
$filter = $_GET['filter'] ?? 'all';

if($filter == "today"){
    $sql = "SELECT * FROM orders 
            WHERE DATE(order_date) = CURDATE()";
}
elseif($filter == "month"){
    $sql = "SELECT * FROM orders 
            WHERE MONTH(order_date)=MONTH(CURDATE()) 
            AND YEAR(order_date)=YEAR(CURDATE())";
}
else{
    $sql = "SELECT * FROM orders";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Report</title>

<style>
/* Blue Admin Buttons */

button{
    background:#0d6efd;
    color:white;
    padding:10px 20px;
    margin:10px 5px;
    border:none;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
}

button:hover{
    background:#084298;
}

/* Table Styling */

table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th{
    background:#f2f2f2;
}

th,td{
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}
</style>


</head>

<body>
<h2>Order Reports</h2>

<form method="GET">
    <button name="filter" value="today">Today Orders</button>
    <button name="filter" value="month">This Month Orders</button>
    <button name="filter" value="all">All Orders</button>
</form>

<table>
<tr>
    <th>Order ID</th>
    <th>User ID</th>
    <th>Total</th>
    <th>Payment</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?= $row['order_id']; ?></td>
    <td><?= $row['user_id']; ?></td>
    <td><?= $row['order_total']; ?></td>
    <td><?= $row['payment_status']; ?></td>
    <td><?= $row['order_status']; ?></td>
    <td><?= $row['order_date']; ?></td>
</tr>

<?php } ?>

</table>
<?php include 'admin_footer.php'; ?>
</body>
</html>
