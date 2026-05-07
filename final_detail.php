<?php 
include "config/db.php"; 
include "header.php";
 
 
$id = $_GET['id']; 
 
$query = "SELECT * FROM products WHERE id='$id'"; 
$data = mysqli_query($conn,$query); 
$product = mysqli_fetch_assoc($data); 
?> 
 
<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href="css/style.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
   .product-page{ 
    display:flex; 
    width:80%; 
    margin:50px auto; 
} 
 
.product-left{ 
    width:50%; 
} 
 
.product-left img{ 
    width:100%; 
    border-radius:10px; 
} 
 
.product-right{ 
    width:50%; 
    padding:40px; 
} 
 
.product-right h1{ 
    font-size:32px; 
    margin-bottom:10px; 
} 
 
.rating{ 
    color:green; 
    margin-bottom:10px; 
} 
 
.price{ 
    font-size:26px; 
    color:#1b7a3a; 
    margin:15px 0; 
} 
 
.price span{ 
    color:gray; 
    text-decoration:line-through; 
    margin-left:15px; 
} 
 
.desc{ 
    font-size:20px; 
    color:#555; 
    margin-bottom:20px; 
} 
 
.qty{ 
    display:flex; 
    gap:10px; 
    margin-bottom:20px; 
} 
 
.qty button{ 
    padding:10px 15px; 
    border:1px solid #ccc; 
    background:white; 
} 
 
.qty input{ 
    width:40px; 
    text-align:center; 
} 
 
.cart-btn{ 
    display:inline-block;
    padding:12px 25px;
    background:#e91e63;
    color:white;
    text-decoration:none;
    border-radius:5px;
    font-size:16px; 
} 
 
.buy-btn{ 
    background:#ff7a00; 
    color:white; 
    padding:12px 30px; 
    border:none; 
    font-size:16px; 
}

.wishlist-btn{
    display:inline-block;
    padding:12px 25px;
    background:#e91e63;
    color:white;
    text-decoration:none;
    border-radius:5px;
    font-size:16px;
}

.wishlist-btn:hover{
    background:#c2185b;
}
</style>
</head> 
<body> 

<div class="product-page"> 
    <div class="product-left"> 
     <img src="uploads/<?php echo $product['image']; ?>"> 
    </div> 
    <div class="product-right"> 
    <h1><?php echo $product['name']; ?></h1> 
    <div class="rating"> 
    <div class="price"> 
        ₹<?php echo $product['price']; ?> 
    </div> 
        <h3>Description:</h3>
    <p class="desc"> 
       <?php echo $product['description']; ?> 
    </p> 
    <h3>🌱 Plant Care Tips:</h3>
    <p class="desc"> 
        <?php echo $product['tips']; ?> 
    </p> 

    <form method="post" action="add_to_cart.php">

    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

     <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="cart-btn">
        <i class="fa fa-shopping-cart"></i></a>

    <a href="wishlist.php?id=<?php echo $product['id']; ?>" class="wishlist-btn">
        <i class="fa fa-heart"></i>

    </a>
	    <a href="buy_now.php?id=<?php echo $product['id']; ?>"class="buy-btn">Buy Now</a>
    </form>
    </div> 
    </div>
</div> 
</body> 
</html>