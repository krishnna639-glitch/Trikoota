<?php
session_start();
include "config/db.php";
include "admin_header.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Products</title>
<style>
.card {
    background: white;
    padding: 20px;
    margin: 20px 0;
    border-radius: 10px;
    box-shadow: 0 0 8px #ccc;
}
.btn{
    padding: 8px 12px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}
</style>
</head>
<body>

<h2>Product Management</h2>

<!-- Total Products -->
<div class="card">
    <h3>Total Products</h3>
    <?php
        $prod = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
        $p = mysqli_fetch_assoc($prod);
        echo "<h1>".$p['total']."</h1>";
    ?>
</div>

<!-- Total Categories -->
<div class="card">
    <h3>Total Categories</h3>
    <?php
        $cat = mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories");
        $c = mysqli_fetch_assoc($cat);
        echo "<h1>".$c['total']."</h1>";
    ?>
</div>

<!-- Add Product Button -->
<a href="add_product.php" class="btn">➕ Add New Product</a>
<a href="admin_salse_report.php" class="btn">Product_salse</a>
<a href="admin_product_stock.php" class="btn">Product_stock</a>
<a href="admin_category_report.php" class="btn">Product_category</a>

<br><br>

<!-- Product List Table -->
<div class="card">
<h3>All Products</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

    <?php
    $sql = "SELECT products.*, categories.category_name 
            FROM products 
            LEFT JOIN categories ON products.categories_id = categories.categories_id";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        echo "
        <tr>
            <td>".$row['id']."</td>
            <td><img src='uploads/".$row['image']."' width='60'></td>
            <td>".$row['name']."</td>
            <td>".$row['category_name']."</td>
            <td>".$row['price']."</td>
            <td>
                <a href='view_product.php?id=".$row['id']."' class='btn'>View</a>
                <a href='edit_product.php?id=".$row['id']."' class='btn'>Edit</a>
                <a href='delete_product.php?id=".$row['id']."' class='btn' style='background:red;'>Delete</a>
            </td>
        </tr>
        ";
    }
    
    ?>
    
</table>
</div>
<?php include 'admin_footer.php'; ?>
</body>
</html>
