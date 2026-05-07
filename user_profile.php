<?php
session_start();
include 'config/db.php';

// Redirect if not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['uid'];

// Fetch user details from database
$query = "SELECT * FROM userr WHERE U_id='$id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .profile-box {
            margin-top: 20px;
            padding: 15px;
            background: #fafafa;
            border-radius: 8px;
            border-left: 5px solid #4CAF50;
        }
        .profile-box p {
            font-size: 18px;
            color: #444;
            margin: 10px 0;
        }
        .btn-container {
            margin-top: 25px;
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            background: #4CAF50;
            color: #fff;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }
        .btn:hover {
            background: #45a049;
        }
        .logout {
            background: #e91e63;
        }
        .logout:hover {
            background: #c2185b;
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <h2>User Profile</h2>

    <div class="profile-box">
        <p><strong>Username:</strong> <?php echo $user['U_name']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['U_email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $user['U_phone']; ?></p>
        <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
        <p><strong>Joined On:</strong> <?php echo $user['created_at']; ?></p>
    </div>

    <div class="btn-container">
        <a class="btn" href="edit_profile.php">Edit Profile</a>
        <a class="btn logout" href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
