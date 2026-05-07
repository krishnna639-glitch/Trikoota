<?php
session_start();
include 'config/db.php';
include 'admin_header.php';

/* OPTIONAL ADMIN LOGIN CHECK*/
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}


// Filter type
$type = $_GET['type'] ?? 'product';

// Queries
if($type == 'category'){
    $title = "📂 Category Wise Stock Report";
    $query = "
        SELECT 
            c.category_name,
            p.name AS product_name,
            p.stock_quantity
        FROM products p
        JOIN categories c ON p.categories_id = c.categories_id
        ORDER BY c.category_name, p.name
    ";
} else {
    $title = "📦 Product Wise Stock Report";
    $query = "
        SELECT 
            p.name AS product_name,
            c.category_name,
            p.stock_quantity
        FROM products p
        JOIN categories c ON p.categories_id = c.categories_id
        ORDER BY p.stock_quantity ASC
    ";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Product Stock</title>
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
    background:#16a34a;
    color:#fff;
    border-radius:8px;
    display:inline-block;
}
.filters a:hover{background:#15803d;}

table{
    width:100%;
    border-collapse:collapse;
}
th, td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
th{
    background:#064e3b;
    color:#fff;
}

.in-stock{
    color:#15803d;
    font-weight:bold;
}
.low-stock{
    color:#d97706;
    font-weight:bold;
}
.sold-out{
    color:#dc2626;
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
    <a href="?type=product">Product Wise</a>
    <a href="?type=category">Category Wise</a>
    <a href="download_products_report.php" class="button">Download Products Report</a>
</div>

<table>
<tr>
    <?php if($type=='category'){ ?>
        <th>Category</th>
        <th>Product</th>
    <?php } else { ?>
        <th>Product</th>
        <th>Category</th>
    <?php } ?>
    <th>Stock</th>
    <th>Status</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $stock = $row['stock_quantity'];

        if($stock == 0){
            $status = "<span class='sold-out'>Sold Out</span>";
        } elseif($stock <= 5){
            $status = "<span class='low-stock'>Low Stock</span>";
        } else {
            $status = "<span class='in-stock'>In Stock</span>";
        }
?>
<tr>
    <?php if($type=='category'){ ?>
        <td><?php echo $row['category_name']; ?></td>
        <td><?php echo $row['product_name']; ?></td>
    <?php } else { ?>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['category_name']; ?></td>
    <?php } ?>
    <td><?php echo $stock; ?></td>
    <td><?php echo $status; ?></td>
</tr>
<?php } } else { ?>
<tr>
    <td colspan="4">No products found</td>
</tr>
<?php } ?>
</table>

</div>
<?php include 'admin_footer.php'; ?>
</body>
</html>
