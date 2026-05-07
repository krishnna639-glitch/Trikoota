<?php
session_start();
include 'config/db.php';
include 'admin_header.php';

/* ===== ADMIN AUTH CHECK ===== */
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

/* ===== FETCH ALL DEALS ===== */
$deals = mysqli_query($conn,
    "SELECT *,
        CASE 
            WHEN CURDATE() < valid_from THEN 'Upcoming'
            WHEN CURDATE() > valid_till THEN 'Expired'
            ELSE 'Active'
        END AS deal_status
     FROM deals
     ORDER BY valid_from DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Deals</title>
<style>
.container{
    max-width:1100px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.top-bar h2{
    color:#2e7d32;
}
.add-btn{
    padding:10px 18px;
    background:#2e7d32;
    color:white;
    text-decoration:none;
    border-radius:8px;
}
.add-btn:hover{
    background:#1b5e20;
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#333;
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
.status.Active{color:green;}
.status.Upcoming{color:orange;}
.status.Expired{color:red;}
.action-btn{
    padding:6px 12px;
    border-radius:6px;
    color:white;
    text-decoration:none;
    margin:2px;
    display:inline-block;
    font-size:14px;
}
.assign{background:#1976d2;}
.view{background:#6a1b9a;}
</style>
</head>

<body>

<div class="container">

    <div class="top-bar">
        <h2>🔥 Deals Management</h2>
        <a href="admin_add_deals.php" class="add-btn">+ Add New Deal</a>
    </div>

    <table>
        <tr>
            <th>Deal Name</th>
            <th>Type</th>
            <th>Value</th>
            <th>Validity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while($d = mysqli_fetch_assoc($deals)): ?>
        <tr>
            <td><?php echo htmlspecialchars($d['deal_code']); ?></td>
            <td><?php echo ucfirst($d['deal_type']); ?></td>
            <td>
                <?php 
                    echo $d['deal_type']=='percent'
                         ? $d['deal_value'].'%'
                         : '₹'.$d['deal_value'];
                ?>
            </td>
            <td>
                <?php echo date('d M Y',strtotime($d['valid_from'])); ?>
                –
                <?php echo date('d M Y',strtotime($d['valid_till'])); ?>
            </td>
            <td class="status <?php echo $d['deal_status']; ?>">
                <?php echo $d['deal_status']; ?>
            </td>
            <td>
                <a href="admin_assign_deal_product.php?deal_id=<?php echo $d['id']; ?>" 
                   class="action-btn assign">Assign Products</a>

                <a href="admin_view_deal_product.php?deal_id=<?php echo $d['id']; ?>" 
                   class="action-btn view">View Products</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>
<?php include 'admin_footer.php'; ?>
</body>
</html>
