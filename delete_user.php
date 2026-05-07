<?php
session_start();
include 'config/db.php';

// // Check if admin is logged in
// if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
//     header("Location: login.php");
//     exit;
// }

// Check if user ID is passed
if (!isset($_GET['id'])) {
    echo "No user selected!";
    exit;
}

$user_id = intval($_GET['id']);

// Check if user is admin
$sql_check = "SELECT R__id FROM userr WHERE U_id = $user_id";
$result = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result) == 0) {
    echo "User not found!";
    exit;
}

$user = mysqli_fetch_assoc($result);

if ($user['R__id'] == 1) {
    echo "Cannot delete admin user!";
    exit;
}

// Delete user
$sql_delete = "DELETE FROM userr WHERE U_id = $user_id";
if (mysqli_query($conn, $sql_delete)) {
    header("Location: admin_users.php");
    exit;
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}
?>
