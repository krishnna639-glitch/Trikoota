<?php if(!isset($_SESSION)) { session_start(); }?>
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
        <?php if(isset($_SESSION['U_id'])){ ?>
            <a href="logout.php">Logout</a>
            <a href="profile.php">👤</a>
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
