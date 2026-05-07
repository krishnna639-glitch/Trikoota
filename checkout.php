<?php
session_start();
include 'config/db.php';
include 'header.php';

/* ========== LOGIN CHECK ========== */
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int)$_SESSION['uid'];

/* ========== FETCH USER ADDRESS ========== */
$user_query = mysqli_query($conn, "SELECT address FROM userr WHERE U_id = $user_id");
$user_data = mysqli_fetch_assoc($user_query);
$user_address = $user_data['address'] ?? 'No Address Found';

/* ========== FETCH CART WITH DEALS ========== */
$cart = mysqli_query($conn,
    "SELECT 
    c.product_id,
    c.quantity,

    p.price AS original_price,

    d.deal_type,
    d.deal_value,
    d.deal_code

FROM cart c
JOIN products p ON c.product_id = p.id
LEFT JOIN deal_products dp ON p.id = dp.product_id
LEFT JOIN deals d 
   ON dp.deal_id = d.id
   AND d.status='active'
   AND CURDATE() BETWEEN d.valid_from AND d.valid_till
WHERE c.user_id = $user_id
"
);

if (mysqli_num_rows($cart) == 0) {
    header("Location: cart.php");
    exit();
}

/* ========== CALCULATE TOTAL (WITH DEALS) ========== */
$total_amount = 0;
$cart_items = [];

while ($row = mysqli_fetch_assoc($cart)) {

    $price = $row['original_price'];

    if (!empty($row['deal_type'])) {
        if ($row['deal_type'] === 'percentage') {
            $price -= ($price * $row['deal_value'] / 100);
        } elseif ($row['deal_type'] === 'flat') {
            $price -= $row['deal_value'];
        }
        if ($price < 0) $price = 0;
    }

    $sub_total = $price * $row['quantity'];
    $total_amount += $sub_total;

    $cart_items[] = [
        'product_id' => $row['product_id'],
        'quantity'   => $row['quantity'],
        'price'      => $price,
        'deal_name'  => $row['deal_code'] ?? null 
    ];
}

/* ========== PLACE ORDER ========== */
if (isset($_POST['place_order'])) {

    mysqli_query($conn,
        "INSERT INTO orders (user_id, order_total, payment_status, order_status)
         VALUES ($user_id, $total_amount, 'Pending', 'Processing')"
    );

    $order_id = mysqli_insert_id($conn);

    foreach ($cart_items as $item) {

        mysqli_query($conn,
            "INSERT INTO order_items 
             (order_id, product_id, quantity, price, deal_name)
             VALUES 
             ($order_id, {$item['product_id']}, {$item['quantity']}, {$item['price']}, ".($item['deal_name'] ? "'{$item['deal_name']}'" : "NULL").")"
        );

        mysqli_query($conn,
            "UPDATE products 
             SET stock_quantity = stock_quantity - {$item['quantity']}
             WHERE id = {$item['product_id']}"
        );
    }

    mysqli_query($conn,
        "INSERT INTO payments 
         (order_id, user_id, amount, payment_method, payment_status)
         VALUES 
         ($order_id, $user_id, $total_amount, 'Cash On Delivery', 'Pending')"
    );

    mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

    header("Location: order_success.php?order_id=$order_id");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>

<style>
body {
    font-family: Arial, sans-serif;
    background:#f4f6f3;
}
.container {
    max-width: 700px;
    margin: 50px auto;
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
h2 {
    text-align:center;
    color:#2e7d32;
}
.summary {
    margin-top:20px;
}
.summary p {
    font-size:18px;
    display:flex;
    justify-content:space-between;
}
.cod-box {
    margin-top:30px;
    background:#e8f5e9;
    padding:20px;
    border-radius:10px;
    border-left:5px solid #2e7d32;
}
.place-btn {
    width:100%;
    margin-top:25px;
    padding:15px;
    background:#2e7d32;
    color:white;
    border:none;
    font-size:18px;
    border-radius:8px;
    cursor:pointer;
}
.place-btn:hover {
    background:#1b5e20;
}
</style>
</head>

<body>

<div class="container">
<h2>Checkout</h2>

<div class="summary">
    <p><span>Payment Method</span><strong>Cash on Delivery</strong></p>
    <p><span>Total Amount</span><strong>₹<?php echo number_format($total_amount,2); ?></strong></p>
    <p><span>Shipping Address</span><strong><?php echo htmlspecialchars($user_address); ?></strong></p>
</div>

<div class="cod-box">
<strong>Cash on Delivery</strong>
<p>Pay when the product is delivered to your doorstep.</p>
</div>

<form method="POST">
<button type="submit" name="place_order" class="place-btn">
Place Order
</button>
</form>

</div>

<?php include 'footer.php'; ?>

</body>
</html>