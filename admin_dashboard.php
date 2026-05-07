<?php
include 'admin_header.php';
include 'config/db.php';

// Total Products
$product_res = mysqli_query($conn, "SELECT COUNT(*) as total_products FROM products");
$product_count = mysqli_fetch_assoc($product_res)['total_products'];

//total_deal_products
$deal_products_res = mysqli_query($conn, "SELECT COUNT(*) as total_deal_products FROM deal_products");
$deal_products_count = mysqli_fetch_assoc($deal_products_res)['total_deal_products'];

// Total Orders
$order_res = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM orders o INNER JOIN userr u ON o.user_id = u.U_id");
$order_count = mysqli_fetch_assoc($order_res)['total_orders'];

// Total Users
$user_res = mysqli_query($conn, "SELECT COUNT(*) as total_users FROM userr");
$user_count = mysqli_fetch_assoc($user_res)['total_users'];

// Total Payments
$payment_res = mysqli_query($conn, "SELECT COUNT(*) as total_payments FROM payments p INNER JOIN userr u ON p.user_id = u.U_id");
$payment_count = mysqli_fetch_assoc($payment_res)['total_payments'];

// Total Messages
$message_res = mysqli_query($conn, "SELECT COUNT(*) as total_messages FROM messages");
$message_count = mysqli_fetch_assoc($message_res)['total_messages'];

?>

<h2 class="text-center mb-4">Admin Dashboard</h2>

<div class="row text-center">

    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white p-3">
            <h4>Total Products</h4>
            <h2><?= $product_count ?></h2>
            <a href="admin_products.php" class="btn btn-light btn-sm mt-2">View Products</a>
        </div>
    </div>

     <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white p-3">
            <h4>Total Deal Products</h4>
            <h2><?= $deal_products_count ?></h2>
            <a href="admin_view_deal_product.php" class="btn btn-light btn-sm mt-2">View Deal Products</a>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white p-3">
            <h4>Total Orders</h4>
            <h2><?= $order_count ?></h2>
            <a href="admin_orders.php" class="btn btn-light btn-sm mt-2">View Orders</a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white p-3">
            <h4>Total Users</h4>
            <h2><?= $user_count ?></h2>
            <a href="admin_users.php" class="btn btn-light btn-sm mt-2">View Users</a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white p-3">
            <h4>Total Payments</h4>
            <h2><?= $payment_count ?></h2>
            <a href="admin_payments.php" class="btn btn-light btn-sm mt-2">View Payments</a>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white p-3">
            <h4>Total Messages</h4>
            <h2><?= $message_count ?></h2>
            <a href="admin_messages.php" class="btn btn-light btn-sm mt-2">View Messages</a>
        </div>
    </div>
</div>



<?php include 'admin_footer.php'; ?>
