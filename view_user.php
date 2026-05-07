<?php
session_start();
include 'config/db.php';

// // Check if admin is logged in
// if (!isset($_SESSION['R__id']) || $_SESSION['R__id'] != 1) {
//     header("Location: login.php");
//     exit;
// }

// Check if user ID is passed
if (!isset($_GET['id'])) {
    echo "<h3>No user selected!</h3>";
    exit;
}

$user_id = intval($_GET['id']);

// Fetch user with role name
$sql = "SELECT userr.*, roles.R_name 
        FROM userr 
        LEFT JOIN roles ON userr.R__id = roles.R__id
        WHERE userr.U_id = $user_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<h3>User not found!</h3>";
    exit;
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .user-container {
            max-width: 600px;
            background: white;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .user-row {
            margin-bottom: 12px;
            font-size: 16px;
        }
        .label {
            font-weight: bold;
        }
        .back-btn {
            display: block;
            width: 200px;
            text-align: center;
            margin: 20px auto;
            padding: 12px;
            background: #444;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .back-btn:hover {
            background: #000;
        }
    </style>
</head>
<body>

<div class="user-container">
    <h2>User Details</h2>

    <div class="user-row">
        <span class="label">User ID: </span> <?php echo $user['U_id']; ?>
    </div>
    <div class="user-row">
        <span class="label">Username: </span> <?php echo $user['U_name']; ?>
    </div>
    <div class="user-row">
        <span class="label">Email: </span> <?php echo $user['U_email']; ?>
    </div>
    <div class="user-row">
        <span class="label">Phone: </span> <?php echo $user['U_phone']; ?>
    </div>
    <div class="user-row">
        <span class="label">Address: </span> <?php echo $user['address']; ?>
    </div>
    <div class="user-row">
        <span class="label">Role: </span> <?php echo ucfirst($user['R_name']); ?>
    </div>
    <div class="user-row">
        <span class="label">Created At: </span> <?php echo $user['created_at']; ?>
    </div>

    <a href="admin_users.php" class="back-btn">Back to Users</a>
</div>

</body>
</html>
