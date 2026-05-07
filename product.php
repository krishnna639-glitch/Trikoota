<?php 
session_start(); 
include "config/db.php";
include "header.php";

// Check login
$user_id = isset($_SESSION['U_id']) ? $_SESSION['U_id'] : 0;

// GET CATEGORY ID
$category_id = isset($_GET['category']) ? $_GET['category'] : '';

// FETCH PRODUCTS
if($category_id != ''){
    $sql = "SELECT * FROM products WHERE categories_id='$category_id'";
}else{
    $sql = "SELECT * FROM products";
}

$result = mysqli_query($conn,$sql);
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<title>Trikoota - Online Plant Store</title> 
 
<!-- Font Awesome --> 
<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
 
<link rel="stylesheet" href="css/style.css"> 

<style> 
/* ❌ CSS NOT CHANGED */
.category-bar{ 
    display:flex; 
    justify-content:center; 
    gap:40px; 
    background:#f3f6f2; 
    padding:15px; 
    font-weight:600; 
} 
.category-bar a{ 
    color:#333; 
    text-decoration:none; 
    transition:0.3s; 
} 
.category-bar a.active, 
.category-bar a:hover{ 
    color:#2e7d32; 
    border-bottom:2px solid #2e7d32; 
} 
.products{ 
    display:grid; 
    grid-template-columns: repeat(auto-fit, minmax(250px,1fr)); 
    gap:30px; 
    padding:40px 50px; 
} 
.card{ 
    background:white; 
    padding:15px; 
    border-radius:10px; 
    box-shadow:0 6px 15px rgba(0,0,0,0.1); 
    text-align:center; 
    transition:0.4s; 
    position:relative; 
} 
.card:hover{ 
    transform: translateY(-5px); 
    box-shadow:0 10px 25px rgba(0,0,0,0.2); 
} 
.card img{ 
    width:100%; 
    height:250px; 
    object-fit:cover; 
    border-radius:8px; 
    transition:0.4s; 
    cursor:pointer; 
} 
.card img:hover{ 
    transform: scale(1.05); 
} 
.card h4{ 
    margin:15px 0 10px 0; 
    font-weight:600; 
    color:#2e7d32; 
    cursor:pointer; 
} 
.card .price{ 
    margin:10px 0 15px 0; 
    font-size:16px; 
} 
.card .price .new{ 
    font-weight:bold; 
    color:#2e7d32; 
    font-size:18px; 
} 
.card button{ 
    width:100%; 
    padding:12px; 
    background:#2e7d32; 
    border:none; 
    color:white; 
    font-size:16px; 
    cursor:pointer; 
    border-radius:5px; 
    transition:0.3s; 
} 
.card button:hover{ 
    background:#e64a19; 
} 
.card .product-icons{ 
    position:absolute; 
    top:10px; 
    right:10px; 
    display:flex; 
    flex-direction:column; 
    gap:10px; 
} 
.card .product-icons a{ 
    color:#2e7d32; 
    font-size:20px; 
    background:white; 
    padding:5px; 
    border-radius:50%; 
    box-shadow:0 2px 5px rgba(0,0,0,0.2); 
    transition:0.3s; 
} 
.card .product-icons a:hover{ 
    background:#ffeb3b; 
} 
@media(max-width:768px){ 
    .navbar-top,.navbar-bottom{ 
        flex-direction:column; 
        align-items:flex-start; 
    } 
    .navbar-bottom .nav-left{ 
        margin-bottom:10px; 
    } 
    .products{ 
        padding:20px; 
        gap:20px; 
    } 
} 
</style> 
</head> 

<body> 

<!-- ✅ DYNAMIC CATEGORY BAR -->
<div class="category-bar"> 
<?php
$cat_query = mysqli_query($conn, "SELECT * FROM categories");

while($cat = mysqli_fetch_assoc($cat_query)){
?>
    <a href="product.php?category=<?php echo $cat['categories_id']; ?>" 
       class="<?php if($category_id == $cat['categories_id']) echo 'active'; ?>">
        <?php echo strtoupper($cat['category_name']); ?>
    </a>
<?php } ?>
</div> 
 
<!-- Products Grid --> 
<div class="products"> 
<?php while($row = mysqli_fetch_assoc($result)) { ?>
    
<div class="card"> 
    <a href="final_detail.php?id=<?php echo $row['id']; ?>" class="product-img">
        <img src="uploads/<?php echo $row['image']; ?>" alt="Product">
        <h4><?php echo $row['name']; ?></h4> 
    </a> 

    <div class="price"> 
        <span class="new">₹<?php echo $row['price']; ?></span>
    </div> 

    <button onclick="location.href='buy_now.php?id=<?php echo $row['id']; ?>'">
        Buy Now
    </button> 

    <div class="product-icons"> 
        <a href="add_to_wishlist.php?id=<?php echo $row['id']; ?>" title="Add to Wishlist">
            <i class="fa fa-heart"></i>
        </a> 
        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" title="Add to Cart">
            <i class="fa fa-shopping-cart"></i>
        </a>
    </div> 
</div> 

<?php } ?> 
</div> 

<?php include 'footer.php'; ?>

</body> 
</html>