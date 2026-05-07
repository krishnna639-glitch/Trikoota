<?php
session_start();
include 'config/db.php';
include 'admin_header.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT o.*, u.U_name, u.U_email 
        FROM orders o
        INNER JOIN userr u ON o.user_id = u.U_id
        ORDER BY o.order_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Orders</title>
        <style>
            
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        table {
            width: 102%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px #ccc;
        }
        th, td {
            padding: 7px 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
        /* ACTION BUTTON CONTAINER */
        .actions{
            display:flex;
            gap:8px;
            justify-content:center;
            align-items:center;
        }

        /* COMMON BUTTON STYLE */
        .action-btn{
            padding:6px 14px;
            border-radius:6px;
            color:white;
            text-decoration:none;
            font-size:14px;
            font-weight:500;
            display:inline-block;
            white-space: nowrap;
        }


        /* VIEW */
        .btn-view{
            background:#0d6efd;
        }
        .btn-view:hover{
            background:#0b5ed7;
        }

        /* UPDATE STATUS */
        .btn-update{
            background:#198754;
        }
        .btn-update:hover{
            background:#157347;
        }

        /* DELETE */
        .btn-delete{
            background:#dc3545;
        }
        .btn-delete:hover{
            background:#bb2d3b;
        }

        .back-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 12px;
            text-align: center;
            background: #444;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .back-btn:hover {
            background: #000;
        }

        .button{
            background:#0d6efd;
            color:white;
            padding:10px 20px;
            margin:10px 5px;
            border:none;
            border-radius:8px;
            font-size:15px;
            cursor:pointer;
            text-decoration:none;
        }

        .button:hover{
            background:#0d6efd;
        }

        </style>
<a href="admin_orders_report.php" class="button">Order_report</a>
<a href="download_orders_report.php" class="button">Download Orders Report</a>
    </head>

<body>

<h2>Orders</h2>

<table>
<tr>
<th>Order ID</th>
<th>User</th>
<th>Email</th>
<th>Date</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['order_id']; ?></td>
<td><?php echo $row['U_name']; ?></td>
<td><?php echo $row['U_email']; ?></td>
<td><?php echo $row['order_date']; ?></td>
<td>₹<?php echo $row['order_total']; ?></td>
<td><?php echo $row['payment_status']; ?></td>

<td>
<?php
if($row['order_status']=='Cancelled'){
    echo "Cancelled by ".($row['cancelled_by'] ? ucfirst($row['cancelled_by']) : 'Admin');

}else{
    echo $row['order_status'];
}
?>
</td>

<td>
<div class="actions">

<a class="action-btn btn-view"
href="view_orders.php?id=<?php echo $row['order_id']; ?>">View</a>

<a class="action-btn btn-update"
href="update_order_status.php?id=<?php echo $row['order_id']; ?>">Update Status</a>

<a class="action-btn btn-delete"
href="delete_order.php?id=<?php echo $row['order_id']; ?>"
onclick="return confirm('Delete order?');">Delete</a>


</div>
</td>

</tr>

<?php } ?>

</table>

<a href="admin_dashboard.php" class="back-btn">Back to dashboard</a>
<?php include 'admin_footer.php'; ?>
</body>
</html>
