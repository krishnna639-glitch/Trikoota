<?php
session_start();
include "config/db.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        echo  "<script>
                alert('Welcome to Admin Dashboard!');
                window.location.href='admin_dashboard.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
body{
    font-family: Arial;
    background: #f6f6f6;
}
.login-box{
    width: 350px;
    background: white;
    padding: 30px;
    margin: 100px auto;
    box-shadow: 0 0 10px #ccc;
    border-radius: 8px;
}
input{
    width: 100%; padding: 10px;
    margin: 10px 0; border: 1px solid #ddd;
    border-radius: 5px;
}
button{
    width: 100%; padding: 10px;
    background: #007bff; color: white;
    border: none; border-radius: 5px;
    cursor: pointer;
}
</style>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>
</div>

</body></html>
