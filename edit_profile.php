<?php
session_start();
include "config/db.php";

// Redirect if not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.html");
    exit;
}

$uid = $_SESSION['uid'];

// Fetch user data
$query = "SELECT * FROM userr WHERE U_id='$uid'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// When user submits form
if (isset($_POST['update'])) {
    
    $username = $_POST['username'];
    $new_email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $id = $user['U_id'];

    // Update basic details
    $update = "UPDATE userr SET 
                U_name='$username',
                U_email='$new_email',
                U_phone='$phone',
                address='$address'
              WHERE U_id='$id'";

    mysqli_query($conn, $update);

    // Update session email if changed
    $_SESSION['user_email'] = $new_email;

    // Update password if entered
    //if (!empty($_POST['password'])) {
    //    $password = $_POST['password'];
    //    mysqli_query($conn, "UPDATE userr SET password='$password' WHERE U_id='{$user['id']}'");
    //}

    echo "<script>
            alert('Profile updated successfully!');
            window.location='user_profile.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }
        .container {
            width: 40%;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }
        h2 {
            text-align: center;
        }
        label {
            font-size: 16px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
        .btn {
            padding: 12px 20px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <h2>Edit Profile</h2>

    <form action="" method="POST">

        <label>Username</label>
        <input type="text" name="username" value="<?php echo $user['U_name']; ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $user['U_email']; ?>" required>

        <label>Phone</label>
        <input type="text" name="phone" value="<?php echo $user['U_phone']; ?>">

        <label>Address</label>
        <textarea name="address"><?php echo $user['address']; ?></textarea>

        <!--<label>New Password (optional)</label>
         <input type="password" name="password" placeholder="Enter new password">-->

        <button class="btn" type="submit" name="update">Update Profile</button>

    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>