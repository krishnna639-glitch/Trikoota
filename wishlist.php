<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['uid'])){
    header("Location: login.php");
    exit();
}

include "header.php";

$user_id = $_SESSION['uid'];

$q = mysqli_query($conn, "
    SELECT wishlist.w_id as wid, products.*
    FROM wishlist
    JOIN products ON wishlist.product_id = products.id
    WHERE wishlist.user_id = $user_id
");

if(!$q){
    die("Query Failed: " . mysqli_error($conn));
}
?>

<style>
    .wishlist-container {
    width: 85%;
    margin: 40px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.wishlist-container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}

.wishlist-table {
    width: 100%;
    border-collapse: collapse;
}

.wishlist-table thead {
    background: linear-gradient(90deg, #1b5e20, #2e7d32);
    color: white;
}

.wishlist-table th,
.wishlist-table td {
    padding: 15px;
    text-align: center;
}

.wishlist-table tbody tr {
    border-bottom: 1px solid #eee;
}

.wishlist-table img {
    width: 70px;
    border-radius: 8px;
}

.move-btn {
    background: #2e7d32;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.remove-btn {
    background: #c62828;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.move-btn:hover {
    background: #1b5e20;
}

.remove-btn:hover {
    background: #8e0000;
}

body{
    background: linear-gradient(to right, #e8f5e9, #f1f8e9);
}

.main-card{
    background:#fff;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.table thead{
    background:#2e7d32;
    color:#fff;
}

.table thead th{
    background:#2e7d32 !important;
    color:#fff !important;
    border:none;
}

.product-img{
    width:80px;
    border-radius:10px;
    object-fit:cover;
}

.btn-success{
    background:#2e7d32;
    border:none;
}

.btn-success:hover{
    background:#1b5e20;
}

.empty-wishlist {
    text-align: center;
    margin-top: 10px;   /* Small space below My Wishlist */
}

.empty-wishlist h5 {
    margin-bottom: 15px;
}

.continue-btn {
    display: inline-block;
    background: #2e7d32;
    color: #fff;
    padding: 10px 22px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
}

.continue-btn:hover {
    background: #1b5e20;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<div class="wishlist-container">
    <h2>❤️ My Wishlist</h2>
    <?php if(mysqli_num_rows($q) > 0){ ?>


    <table class="wishlist-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price (₹)</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>


<?php while($row = mysqli_fetch_assoc($q)){ ?>
<tr>
    <td>
        <img src="uploads/<?php echo $row['image']; ?>" class="product-img">
    </td>

    <td>
        <?php echo $row['name']; ?>
    </td>

    <td>
        ₹<?php echo $row['price']; ?>
    </td>

    <td>
    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" 
   class="move-btn">Move to Cart</a>

<a href="remove_wishlist.php?id=<?php echo $row['wid']; ?>" 
   class="remove-btn">Remove</a>

    </td>
</tr>
<?php } ?>

</body>
</table>

<?php } else { ?>

<div class="empty-wishlist">
    <h5>Your wishlist is empty 💔</h5>

    <a href="product.php" class="continue-btn">
        Continue Shopping
    </a>
</div>

<?php } ?>

</div>

<?php include "footer.php"; ?>
