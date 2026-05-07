<?php
include "config/db.php";
include "admin_header.php";

$cat = $_GET['cat'] ?? 'all';

/* FETCH CATEGORIES FOR BUTTONS */
$cats = mysqli_query($conn,"SELECT * FROM categories");

/* PRODUCT QUERY */

if($cat == 'all'){
    $sql = "SELECT p.*, c.category_name
            FROM products p
            JOIN categories c ON p.categories_id=c.categories_id";
}else{
    $cat = mysqli_real_escape_string($conn,$cat);

    $sql = "SELECT p.*, c.category_name
            FROM products p
            JOIN categories c ON p.categories_id=c.categories_id
            WHERE c.category_name='$cat'";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Product Category Report</title>

<style>

button{
    background:#0d6efd;
    color:white;
    padding:10px 20px;
    margin:6px;
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

</style>

</head>

<body>

<h2>Product Category Reports</h2>

<form method="GET">

<button name="cat" value="all">All Products</button>

<?php while($c=mysqli_fetch_assoc($cats)){ ?>

<button name="cat" value="<?= $c['category_name']; ?>">
    <?= $c['category_name']; ?>
</button>

<?php } ?>

</form>

<table>

<tr>
<th>ID</th>
<th>Product</th>
<th>Category</th>
<th>Price</th>
<th>Stock</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?= $row['id']; ?></td>
<td><?= $row['name']; ?></td>
<td><?= $row['category_name']; ?></td>
<td>₹<?= $row['price']; ?></td>
<td><?= $row['stock_quantity']; ?></td>
</tr>

<?php } ?>

</table>
<?php include 'admin_footer.php'; ?>
</body>
</html>
