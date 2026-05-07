<?php
session_start();
include "config/db.php";

// If user not logged in → redirect
/* ================== AUTH CHECK ================== */
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}


// fetch categories
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name");


?>

<!DOCTYPE html>
<html>
    <head>
    <title>Trikoota</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
    <header class="main-header"> 
    <div class="header-left"> 
            <img src="images/plant.png" alt="Logo" class="logo"> 
            <div class="brand">
                <span class=brand-name>TRIKOOTA</span>
                <span class="brand-tagline">Make Green ,Leave With Green</span>
            </div>
    </div>
    <div class="nav-row">
        <div class="nav-menu">
                    <a href="trikoota.php">Home</a>
                    <a href="product.php">Shop</a>
                    <a href="deals.php">Deals</a>
                    <a href="support.php">Support</a>
            </div>
        <div class="nav-right">
            <?php if(isset($_SESSION['Uid'])){ ?>
            <a href="logout.php" class="logout">Logout</a>
            <?php } 
        else
        { ?>
            <a href="login.php" class="login">Login/Register</a>
            
            <?php } ?>
        
                <div class="search-container"> 
                    <input type="text" placeholder="Search"> 
                    <button><i class="fa fa-search"></i></button> 
                </div> </li>
                <!-- Wishlist -->
                <a href="wishlist.php">
                <img class="icon" src="https://cdn-icons-png.flaticon.com/512/833/833472.png" title="Wishlist"></a>
                <!-- Order Status -->
                <a href="order_status.php">
                <img class="icon" src="https://cdn-icons-png.flaticon.com/512/8782/8782986.png" title="Order Status"></a>
                <!-- Cart -->
                <a href="cart.php">
                <img class="icon" src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png" title="Cart"></a>
                <!-- PROFILE DROPDOWN -->
        
                <div class="profile-container">
                    <img class="profile-icon"
                        src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png"
                        title="User Profile"
                        id="profileBtn">

                    <div class="dropdown" id="profileDropdown">
                        <a href="user_profile.php">👤 My Profile</a>
                        <a href="my_orders.php">📦 My Orders</a>
                        <a href="wishlist.php">❤️ Wishlist</a>

                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === "1") { ?>
                            <a href="admin_login.php">⚙ Admin Panel</a>
                        <?php } ?>

                        <a href="logout.php">🚪 Logout</a>
                    </div>
                </div>
    <!--main--></div>
</div>
</header>
<body> 
<!-- SLIDER --> 
<section>
<div class="slider"> 
    <div class="slides fade"> 
        <img src="images/hero1.jpg"> 
        <div class="caption"><h1>"Live in the sunshine, swim the sea, drink the wild air.” A tree is known by its fruit.” Nature
             always wears the colors of the spirit.” The earth laughs in flowers."</h1></div> 
    </div> 
    <div class="slides fade"> 
        <img src="images/hero2.jpg"> 
        <div class="caption"><h1>"The true meaning of life is to plant trees, 
            under whose shade you do not expect to sit."</h1></div> 
    </div> 
    
    <div class="slides fade"> 
        <img src="images/hero4.jpg"> 
        <div class="caption"><h1>"Love is like a tree, it grows of its own accord,
             it puts down deep roots into our whole being."</h1></div>
    </div>
</div>
</section>


<!-- CATEGORIES -->
<section class="section">
<h2>Shop by Category</h2>
<div class="categories">
<?php while($cat = mysqli_fetch_assoc($categories)){ ?>
<a href="product.php?category=<?php echo $cat['categories_id']; ?>" class="category-card">
    <img src="uploads/categories/<?php echo $cat['image']; ?>">
    <div class="category-title"><?php echo $cat['category_name']; ?></div>
</a>
<?php } ?>
</div>
</section>
<!-- MOTIVE -->
<section class="section">
<h2>Why TRIKOOTA !</h2>
<div class="motive">
    <img src="images/motiv.jpg">
    <p>
        At <b>Trikoota</b>, we believe nature is not a luxury — it is a necessity.
        Every plant we grow is a step towards cleaner air, calmer minds, and
        sustainable living. Our mission is to reconnect people with nature
        through carefully nurtured plants.
    </p>
</div>
</section>

<footer class="footer"> 
  <div class="footer-container"> 
    <div class="footer-box"> 
      <h3>WEBSITE</h3> 
      <a href="website.php">About Us</a> 
      <a href="website.php">Our Mission</a> 
      <a href="website.php">Why Us?</a> 
    </div> 
    <div class="footer-box"> 
      <h3>GET HELP</h3> 
      <a href="refund.php">Return & Refund</a> 
      <a href="policy.php">Privacy Policy</a> 
      <a href="condition.php">Terms & Conditions</a> 
    </div> 
    <div class="footer-box"> 
      <h3>SERVICES</h3> 
      <a href="gift.php">Corporate Gifting</a> 
      <a href="garden.php">Garden Maintenance</a> 
      <a href="balcony.php">Balcony Garden</a> 
    </div>  
    <div class="footer-box"> 
      <h3>EXCLUSIVE BENEFITS</h3> 
      <p>Subscribe for offers & deals</p> 
      <input type="email" placeholder="Enter your email"> 
      <button>Subscribe</button> 
    <div class="social-icons"> 
        <span>f</span> 
        <span>x</span> 
        <span>p</span> 
        <span>in</span> 
      </div> 
    </div> 
 </div> 
 <div class="footer-bottom"> 
    © 2026 Trikoota. All Rights Reserved. 
  </div> 
</footer>
</body>
</html>

<script>
document.getElementById("profileBtn").addEventListener("click", function () {
    const dropdown = document.getElementById("profileDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// Close dropdown when clicking outside
document.addEventListener("click", function (e) {
    const profile = document.querySelector(".profile-container");
    if (!profile.contains(e.target)) {
        document.getElementById("profileDropdown").style.display = "none";
    }
});
</script>
