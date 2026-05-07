<?php
session_start();
include 'config/db.php';
include 'admin_header.php';

?>
<style>
     table {
            width: 102%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px #ccc;
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
<a href="admin_payment_report.php" class="button">Payment_report</a>
<a href="download_payment_report.php" class="button">Download Payment Report</a>
<h2 class="text-center mb-4">Payments</h2>

<?php
$sql = "SELECT 
        p.*, 
        o.payment_status,
        o.order_total,
        u.U_name
        FROM payments p
        JOIN orders o ON p.order_id = o.order_id
        JOIN userr u ON o.user_id = u.U_id
        ORDER BY p.payment_id DESC
        ";

$result = mysqli_query($conn, $sql);
?>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Order ID</th>
            <th>Order Total</th>
            <th>Amount Paid</th>
            <th>Method</th>
            <th>Status</th>
            <th>Payment Date</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['payment_id']; ?></td>
                    <td><?php echo $row['U_name']; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td>₹<?php echo $row['order_total']; ?></td>
                    <td>₹<?php echo $row['amount']; ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td>
                        <span class="badge bg-success"><?php echo $row['payment_status']; ?></span>
                    </td>
                    <td><?php echo $row['payment_date']; ?></td>
                    <td>
                        <a href="view_payment.php?id=<?php echo $row['payment_id']; ?>" class="btn btn-info btn-sm">View</a>
                        <a href="delete_payment.php?id=<?php echo $row['payment_id']; ?>" 
                        class="btn btn-danger btn-sm" 
                        onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                    

                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center text-danger'>No payments found</td></tr>";
        }
        ?>
    </tbody>
    
</table>
<div class="text-center mt-3">
    <a href="admin_dashboard.php" class="btn btn-dark">Back to Dashboard</a>
</div>
<?php include 'admin_footer.php'; ?>