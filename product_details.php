<?php php session_start(); 
include "config/db.php";
include 'header.php';
// if (!$conn) { 
//     die("Database connection failed"); 
// } 
 
if (!isset($_GET['id'])) { 
    die("Product ID missing"); 
} 
 
$id = intval($_GET['id']); 
 
$q = mysqli_query($conn, "SELECT * FROM products WHERE id = $id"); 
 
if (mysqli_num_rows($q) == 0) { 
    die("Product not found"); 
} 
 
$p = mysqli_fetch_assoc($q); 
?> 
 
<!DOCTYPE html> 
<html> 
<head> 
    <title><?php echo $p['name']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style> 
        body{
            background-color:#dff5b0;
        }
        .box{ 
            width:450px; 
            margin:40px auto; 
            border:1px solid #96c799ff; 
            background:#96c799ff;
            padding:20px; 
        } 
        img{ 
            width:100%; 
            height:280px; 
            object-fit:cover; 
        } 
        h2{ 
            margin:10px 0; 
        } 
        .price{ 
            font-size:18px; 
            font-weight:bold; 
        } 
        .cart{ 
            background:#ff6a1b; 
            color:white; 
            padding:10px 12px; 
            border:none; 
            cursor:pointer; 
        }
        .buy-now-btn{
            background-color:#28a745;
            color:white;
            padding:10px 12px;
            border:none;
            cursor:pointer;
        } 
        .buy-now-btn:hover{
            background-color:#218838;}

    </style> 
</head> 
 
<body>


<div class="box"> 
    <img src="uploads/<?php echo $p['image']; ?>"> 
 
    <h2><?php echo $p['name']; ?></h2> 
    <p class="price">₹<?php echo $p['price']; ?></p> 
    <p><?php echo $p['description']; ?></p> 

    <form method="post" action="buy_now.php"> 
        <input type="hidden" name="pid" value="<?php echo $p['id']; ?>"> 
        <button class="buy-now-btn">Buy Now</button> 
    </form> 
</div> 
 
</body> 
</html>
<?php include "footer.php"; ?>