<?php
session_start();
include 'config/db.php';
include 'admin_header.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$type = $_GET['type'] ?? 'day';

/* ================= DAY WISE PRODUCT REPORT ================= */
if($type == 'day'){
    $title = "📅 Day Wise Product Sales Report";
    $query = "
        SELECT 
            DATE(o.order_date) AS order_date,
            p.name AS product_name,
            SUM(oi.quantity * oi.price) AS total
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        WHERE o.order_status = 'Delivered'
        GROUP BY DATE(o.order_date), p.id
        ORDER BY order_date DESC
    ";
}

/* ================= CATEGORY WISE ================= */
elseif($type == 'category'){
    $title = "📂 Category Wise Sales Report";
    $query = "
        SELECT c.category_name AS label,
               SUM(oi.quantity * oi.price) AS total
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        JOIN categories c ON p.categories_id = c.categories_id
        WHERE o.order_status = 'Delivered'
        GROUP BY c.categories_id
        ORDER BY total DESC
    ";
}

/* ================= PRODUCT WISE ================= */
else{
    $title = "📦 Product Wise Sales Report";
    $query = "
        SELECT p.name AS label,
               SUM(oi.quantity) AS qty,
               SUM(oi.quantity * oi.price) AS total
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        WHERE o.order_status = 'Delivered'
        GROUP BY p.id
        ORDER BY total DESC
    ";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Sales Report</title>
<style>
body{
    font-family: Arial, sans-serif;
    background:#f3f4f6;
    margin:0;
}
.container{
    max-width:1000px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}
h2{text-align:center;}
.filters{
    text-align:center;
    margin-bottom:20px;
}
.filters a{
    text-decoration:none;
    padding:10px 18px;
    margin:5px;
    background:#2563eb;
    color:#fff;
    border-radius:8px;
    display:inline-block;
}
.filters a:hover{background:#1e40af;}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
th, td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
th{
    background:#111827;
    color:#fff;
}
.total{
    text-align:right;
    font-size:20px;
    margin-top:15px;
    font-weight:bold;
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
    background:#0b5ed7;
}
</style>
</head>

<body>
<div class="container">

<h2><?php echo $title; ?></h2>

<div class="filters">
    <a href="?type=day">Day Wise</a>
    <a href="?type=category">Category Wise</a>
    <a href="?type=product">Product Wise</a>
    <a href="download_sales_report.php" class="button">Download Sales Report</a>
</div>

<table>
<tr>
<?php if($type=='day'){ ?>
    <th>Date</th>
    <th>Product Name</th>
<?php } else { ?>
    <th>Name</th>
<?php } ?>

<?php if($type=='product'){ ?>
    <th>Quantity Sold</th>
<?php } ?>

<th>Total Sales (₹)</th>
</tr>

<?php
$grandTotal = 0;

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $grandTotal += $row['total'];
?>
<tr>

<?php if($type=='day'){ ?>
    <td><?php echo $row['order_date']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
<?php } else { ?>
    <td><?php echo $row['label']; ?></td>
<?php } ?>

<?php if($type=='product'){ ?>
    <td><?php echo $row['qty']; ?></td>
<?php } ?>

<td>₹<?php echo number_format($row['total'],2); ?></td>

</tr>
<?php } } else { ?>
<tr>
    <td colspan="4">No sales data found</td>
</tr>
<?php } ?>
</table>

<div class="total">
    Grand Total Sales: ₹<?php echo number_format($grandTotal,2); ?>
</div>

</div>
<?php include 'admin_footer.php'; ?>
</body>
</html>