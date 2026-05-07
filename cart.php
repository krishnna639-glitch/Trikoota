<?php
session_start();
include 'config/db.php';
include "header.php";

/* ================== AUTH CHECK ================== */
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int)$_SESSION['uid'];

/* ================== UPDATE QUANTITY ================== */
if (isset($_POST['update_qty'])) {
    $cart_id = (int)$_POST['cart_id'];
    $qty     = max(1, (int)$_POST['quantity']); // minimum 1

    mysqli_query(
        $conn,
        "UPDATE cart 
         SET quantity = $qty 
         WHERE id = $cart_id AND user_id = $user_id"
    );
}

/* ================== REMOVE ITEM ================== */
if (isset($_GET['remove'])) {
    $cart_id = (int)$_GET['remove'];

    mysqli_query(
        $conn,
        "DELETE FROM cart 
         WHERE id = $cart_id AND user_id = $user_id"
    );
}

/* ================== FETCH CART ================== */
$cart_result = mysqli_query(
    $conn,
    "SELECT 
        c.id,
        c.quantity,

        p.id AS product_id,
        p.name,
        p.price AS original_price,
        p.image,

        d.deal_type,
        d.deal_value

     FROM cart c
     JOIN products p ON c.product_id = p.id

     LEFT JOIN deal_products dp ON p.id = dp.product_id
     LEFT JOIN deals d 
        ON dp.deal_id = d.id
        AND d.status = 'active'
        AND CURDATE() BETWEEN d.valid_from AND d.valid_till

     WHERE c.user_id = $user_id"
);

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin:0;
    padding:0;
}
.container {
    max-width: 900px;
    margin: 40px auto;
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}
h2 {
    text-align:center;
    margin-bottom:25px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
table th {
    background: #2e7d32;
    color: white;
    padding: 12px;
}
table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}
.product-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}
.btn {
    padding: 8px 15px;
    border-radius: 7px;
    text-decoration: none;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}
.btn-update {
    background: #16a34a;
}
.btn-update:hover {
    background: #0e7d34;
}
.btn-remove {
    background: #dc2626;
}
.btn-remove:hover {
    background: #991b1b;
}
.checkout-btn {
    display: inline-block;
    background: #2e7d32;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    margin-top: 20px;
    text-decoration: none;
}
.checkout-btn:hover {
    background: #1b5e20;
}
.total-box {
    text-align: right;
    font-size: 20px;
    margin-top: 15px;
}
.empty {
    text-align:center;
    font-size:18px;
    padding:20px;
}
</style>
</head>

<body>

<div class="container">
    <h2>🛒 My Cart</h2>

<?php if (mysqli_num_rows($cart_result) > 0): ?>
    <table>
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price (₹)</th>
            <th>Quantity</th>
            <th>Total (₹)</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($cart_result)):
            $price = $row['original_price'];

		// APPLY DEAL IF EXISTS
		if (!empty($row['deal_type'])) {

			if ($row['deal_type'] === 'percentage') {
				$price -= ($price * $row['deal_value'] / 100);
			} 
			elseif ($row['deal_type'] === 'flat') {
				$price -= $row['deal_value'];
			}

			if ($price < 0) {
				$price = 0;
			}
		}

		$sub_total = $price * $row['quantity'];
		$total += $sub_total;

        ?>
        <tr>
    <td>
        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" class="product-img">
    </td>

    <td><?php echo htmlspecialchars($row['name']); ?></td>

    <!-- PRICE COLUMN -->
    <td>
        <?php if (!empty($row['deal_type'])): ?>
            <del style="color:#888;">
                ₹<?php echo number_format($row['original_price'], 2); ?>
            </del><br>

            <strong style="color:#2e7d32;">
                ₹<?php echo number_format($price, 2); ?>
            </strong>

            <div style="font-size:12px;color:red;">🔥 Deal Applied</div>
        <?php else: ?>
            ₹<?php echo number_format($row['original_price'], 2); ?>
        <?php endif; ?>
    </td>

    <!-- QUANTITY -->
    <td>
        <form method="POST" style="display:inline-flex; gap:5px;">
            <input type="number" name="quantity"
                   value="<?php echo $row['quantity']; ?>"
                   min="1" style="width:60px;">
            <input type="hidden" name="cart_id"
                   value="<?php echo $row['id']; ?>">
            <button type="submit" name="update_qty"
                    class="btn btn-update">Update</button>
        </form>
    </td>

    <!-- TOTAL -->
    <td>₹<?php echo number_format($sub_total, 2); ?></td>

    <!-- ACTION -->
    <td>
        <a href="cart.php?remove=<?php echo $row['id']; ?>"
           class="btn btn-remove"
           onclick="return confirm('Remove this item?')">
           Remove
        </a>
    </td>
</tr>

        <?php endwhile; ?>
    </table>

    <div class="total-box">
        <strong>Grand Total: ₹<?php echo number_format($total, 2); ?></strong>
    </div>

    <a href="checkout.php" class="checkout-btn">
        Proceed to Checkout
    </a>

<?php else: ?>
    <p class="empty">Your cart is empty.</p>
<?php endif; ?>

</div>
<?php include 'footer.php'; ?>

</body>
</html>
