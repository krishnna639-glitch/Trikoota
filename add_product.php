<?php
session_start();
include "config/db.php";
include 'admin_header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - add - Products</title>
<style>
/* Paste your form CSS here (same as add_product.php) */
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            padding: 20px;
        }
        .form-container {
            background: #fff;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #34495e;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"],
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #dcdde1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
            transition: 0.3s;
        }
        .form-container input:focus,
        .form-container textarea:focus,
        .form-container select:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }
        .form-container input[type="file"] {
            border: 1px dashed #95a5a6;
            background: #ecf0f1;
            cursor: pointer;
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #2980b9;
        }</style>
</head>
<body>
<div class="form-container">
<h2>Add Product</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Product Name</label>
    <input type="text" name="name" required><br>

    <label>Product Description</label>
    <input type="text" name="description" required><br>

     <label>Plants care tips</label>
    <input type="text" name="tips" required><br>

    <label>Product price</label>
    <input type="text" name="price" required><br>

    <label>Product Quantity</label>
    <input type="text" name="quantity" required><br>

    <label>Upload Image</label>
    <input type="file" name="image" required><br>

    <label>Product category no:</label>
    <input type="text" name="category" required><br>
    
    <button type="submit" name="add">Add Product</button><br>
</form>
<?php include 'admin_footer.php'; ?>
</body>
</html>

<?php
include "config/db.php";

if(isset($_POST['add'])){

    $name = $_POST['name'];

    $description = $_POST['description'];

    $tips = $_POST['tips'];

    $price = $_POST['price'];

    $quantity = $_POST['quantity'];

    $categories_id = $_POST['category'];

    // Getting file name
    $image = $_FILES['image']['name'];

    // Temporary file path
    $tmp = $_FILES['image']['tmp_name'];

    // Upload target path
    $path = "uploads/" . $image;

    // Move file to uploads folder
    move_uploaded_file($tmp, $path);

    // Save file path to database
    $sql = "INSERT INTO products (name, price, description,tips, image, stock_quantity, categories_id) 
    VALUES ('$name','$price', '$description','$tips', '$image', '$quantity', '$categories_id')";
    mysqli_query($conn, $sql);

    echo "<script>alert('Product Added Successfully');</script>";
}
?>

