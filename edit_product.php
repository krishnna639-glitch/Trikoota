<?php
session_start();
include "config/db.php";

// Check if admin is logged in
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

// Get product id from URL
if(!isset($_GET['id'])){
    header("Location: admin_products.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: admin_products.php"); // redirect if no id
    exit();
}

$product_id = intval($_GET['id']); // always cast to int for safety


//$product_id = $_GET['id'];

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// Fetch categories for dropdown
$categories = mysqli_query($conn, "SELECT * FROM categories");

// Handle form submission
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $tips = $_POST['tips'];

    // Check if image is uploaded
    if($_FILES['image']['name'] != ""){
        $image = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);

        // Update with new image
        $update_sql = "UPDATE products 
                       SET name='$name', categories_id='$category_id', price='$price', description='$description', image='$image' ,
                       tips='$tips' WHERE id=$product_id";
    } else {
        // Update without changing image
        $update_sql = "UPDATE products 
                       SET name='$name', categories_id='$category_id', price='$price', description='$description' ,tips='$tips' WHERE id=$product_id";
    }

    mysqli_query($conn, $update_sql);
    echo "<script>alert('Product Updated Successfully'); window.location='admin_products.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
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
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">

        <label>Product Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label>Category</label>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php while($cat = mysqli_fetch_assoc($categories)){ ?>
                <option value="<?php echo $cat['categories_id']; ?>" 
                    <?php if($cat['categories_id'] == $product['categories_id']) echo "selected"; ?>>
                    <?php echo $cat['category_name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Price</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>

        <label>Description</label>
        <textarea name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label>Plant care tips</label>
        <textarea name="tips" rows="4"><?php echo htmlspecialchars($product['tips']); ?></textarea>

        <label>Current Image</label>
        <img src="uploads/<?php echo $product['image']; ?>" width="150" style="display:block;margin-bottom:10px;">

        <label>Change Image</label>
        <input type="file" name="image">

        <button type="submit" name="update">Update Product</button>
    </form>
</div>

</body>
</html>
