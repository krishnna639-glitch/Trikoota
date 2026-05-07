<?php
session_start();
include 'config/db.php';
include 'header.php';

/* CHECK LOGIN */
if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

$user_id = (int)$_SESSION['uid'];

/* FETCH USER ORDERS */
$orders = mysqli_query($conn,
    "SELECT * FROM orders 
     WHERE user_id = $user_id 
     ORDER BY order_id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f3;
}
.container{
    max-width:900px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}
h2{
    text-align:center;
    color:#2e7d32;
    margin-bottom:25px;
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
.status{
    font-weight:bold;
}
.pending{color:#e65100;}
.processing{color:#1565c0;}
.completed{color:#2e7d32;}
.btn{
    padding:8px 15px;
    background:#2e7d32;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-size:14px;
}
.btn:hover{
    background:#1b5e20;
}
.empty{
    text-align:center;
    font-size:18px;
    padding:30px;
}
.actions{
    display:flex;
    justify-content:flex-start;
    gap:8px;
}

.actions a{
    display:inline-flex !important;
    align-items:center;
    white-space:nowrap;
}


</style>
</head>

<body>

<div class="container">
    <h2>📦 My Orders</h2>

    <?php if(mysqli_num_rows($orders) > 0){ ?>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Total (₹)</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($orders)){ ?>
        <tr>
            <td>#<?php echo $row['order_id']; ?></td>
            <td><?php echo date('d M Y', strtotime($row['order_date'])); ?></td>
            <td><?php echo number_format($row['order_total'],2); ?></td>
            <td class="status <?php echo strtolower($row['payment_status']); ?>">
                <?php echo $row['payment_status']; ?>
            </td>
            <td>
            <?php
            if($row['order_status']=='Cancelled'){
                // echo "Cancelled by ".ucfirst($row['cancelled_by']);
                echo "Cancelled by ".($row['cancelled_by'] ? ucfirst($row['cancelled_by']) : 'Admin');
            }else{
                echo $row['order_status'];
            }
            ?>
            </td>

            <td>
            <div class="actions">
                <a href="view_orders.php?id=<?php echo $row['order_id']; ?>" class="btn">
                    View
                </a>
                <?php if($row['order_status']=='Pending'){ ?>
                <a href="cancel_order.php?id=<?php echo $row['order_id']; ?>"
                onclick="return confirm('Cancel this order?');"
                class="btn">
                    Cancel
                </a>
                <?php } ?>
            </div>
            </td>

        </tr>
        <?php } ?>
    </table>

    <?php } else { ?>
        <p class="empty">You have not placed any orders yet.</p>
    <?php } ?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
