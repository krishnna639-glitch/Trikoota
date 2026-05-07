<?php
if(!isset($_SESSION)) { session_start(); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Panel</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto">

         <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
       
        <li class="nav-item"><a class="nav-link" href="admin_products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_deals.php">Deals</a></li>


        <li class="nav-item"><a class="nav-link" href="admin_users.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_orders.php">Orders</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_payments.php">Payments</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_messages.php">Messages</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_logout.php">Logout</a></li>
        

      </ul>
    </div>

  </div>
</nav>

<div class="container mt-4">
