<?php
include 'config/db.php';

// Check if product id exists
if (!isset($_GET['id'])) {
    echo "<h3>No product selected!</h3>";
    exit;
}

$product_id = intval($_GET['id']);

// Fetch product details
$sql = "SELECT p.*, c.category_name 
        FROM products p 
        LEFT JOIN categories c ON p.categories_id = c.categories_id
        WHERE p.id = $product_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<h3>Product not found!</h3>";
    exit;
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f4f4f4;
        }
        .product-container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        .product-container h2 {
            text-align: center;
        }
        .product-img {
            width: 100%;
            max-height: 300px;
            object-fit: contain;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .product-row {
            margin-bottom: 12px;
            font-size: 16px;
        }
        .label {
            font-weight: bold;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #444;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-back:hover {
            background: #000;
        }
    </style>
</head>
<body>

<div class="product-container">
    <h2>Product Details</h2>

    <!-- Product Image -->
    <img src="uploads/<?php echo $product['image']; ?>" class="product-img">

    <div class="product-row">
        <span class="label">Product Name: </span>
        <?php echo $product['name']; ?>
    </div>

    <div class="product-row">
        <span class="label">Category: </span>
        <?php echo $product['category_name']; ?>
    </div>

    <div class="product-row">
        <span class="label">Price: </span>
        ₹<?php echo $product['price']; ?>
    </div>

    <div class="product-row">
        <span class="label">Stock: </span>
        <?php echo $product['stock_quantity']; ?>
    </div>

    <div class="product-row">
        <span class="label">Description: </span><br>
        <?php echo nl2br($product['description']); ?>
    </div>

    <a href="admin_products.php" class="btn-back">Back to Products</a>
</div>

</body>
</html>
