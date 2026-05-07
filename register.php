<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include "config/db.php"; 

if(isset($_POST['register']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
   // $email = mysqli_real_escape_string($conn,$_POST['email']);
    $email = strtolower(mysqli_real_escape_string($conn,$_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);

    // Check if email already exists
    $checkEmail = mysqli_query($conn, "SELECT * FROM userr WHERE U_email='$email'");

    if(mysqli_num_rows($checkEmail) > 0){
        echo "<script>alert('Email already registered! Please login.');</script>";
    } 
    else {
        $sql = "INSERT INTO userr (U_name, U_email, password, U_phone, address) 
            VALUES ('$name', '$email', '$password', '$phone', '$address')";

        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Registration successful! Please login.');</script>";
            header("Location: login.php");
            exit();
        } else {
        die("Insert Error:" . mysqli_error($conn));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register | Trikoota</title>
<link rel="stylesheet" href="css/style.css">

<!-- Font Awesome for Eye Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* ---- YOUR ORIGINAL CSS UNCHANGED ---- */
body {
    margin: 0;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    background: url("images/register2.jpg") no-repeat center center;
    background-size: cover;
    display: flex;
    flex-direction: column;
}
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 80px;
    z-index: 9999;
}
.page-space {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}
.container {
    width: 380px;
    background: #e4f7d4;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
.container h2{
    text-align:center;
    margin-bottom:5px;
    letter-spacing:1px;
}
.page-center {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 80px;
}
.input-group{
    margin-bottom:10px;
    position:relative;
}
.input-group label{
    font-size:14px;
    display:block;
    margin-bottom:3px;
}
.input-group input,
.input-group textarea{
    width:100%;
    border:1px solid#999;
    border-radius:5px;
    box-sizing:border-box;
    padding:10px;
    outline:none;
    font-size:14px;
    background:#fff;
}
.input-group textarea{
    height:80px;
    resize:none;
}
.input-group input:focus,
.input-group select:focus{
    border-color:#4caf50;
}
.btn{
    width:100%;
    background:#bcbcbc;
    border:none;
    padding:10px;
    border-radius:20px;
    font-size:16px;
    cursor:pointer;
    margin-top:10px;
}
.btn:hover{
    background:#a0a0a0;
}
.bottom-text{
    text-align:center;
    margin-top:15px;
    font-size:14px;
}
.bottom-text a{
    text-decoration:none;
    color:#000;
    font-weight:bold;
}
@keyframes fadeIn { 
    from { opacity: 0; transform: scale(0.9); } 
    to { opacity: 1; transform: scale(1); } 
}
body { 
    animation: fadeIn 1s ease; 
    background: url("images/register2.jpg")no-repeat center center;
    background-size: cover;
}
.register-box { 
    animation: popUp 1s ease; 
}
@keyframes popUp { 
    from { opacity: 0; transform: translateY(40px); } 
    to { opacity: 1; transform: translateY(0); } 
}
input { 
    transition: 0.3s; 
}
input:focus { 
    border: 2px solid #27ae60; 
    box-shadow: 0 0 10px #27ae60; 
}
button { 
    background: #27ae60; 
    color: white; 
    padding: 12px; 
    border: none; 
    transition: 0.4s; 
    cursor: pointer; 
}
button:hover { 
    background: #219150; 
    transform: scale(1.07); 
}
</style>
</head>
<body>

<?php include "header.php"; ?>

<div class="page-center">
<div class="container">
<h2>Register</h2>

<?php 
if (isset($_GET['msg']) && $_GET['msg']=="not_registered")
{
    echo "<script> alert('Username not found,Please do registration.');</script>";
}
?>

<div id="regError" style="color:red; text-align:center; margin-bottom:10px;"></div>

<form method="post" action="register.php" onsubmit="return validateRegisterForm();">

<div class="input-group">
<label>Username</label>
<input type="text" name="name" id="username" placeholder="Full Name" required>
</div>

<div class="input-group">
<label>Email</label>
<input type="email" name="email" id="email" placeholder="Email" required>
</div>

<div class="input-group">
<label>Password</label>
<input type="password" name="password" id="password" placeholder="Password" required>
<i class="fa fa-eye" id="togglePassword" 
   style="position:absolute; right:10px; top:38px; cursor:pointer;"></i>
</div>

<div class="input-group">
<label>Phone</label>
<input type="text" name="phone" id="phone" placeholder="Phone" required>
</div>

<div class="input-group">
<label>Address</label>
<input type="text" name="address" id="address" placeholder="Enter your address" required>
</div>

<button type="submit" name="register" class="btn">Register</button>

</form>

<p>Already have an account? 
<a href="login.php">Login here</a>
</p>

</div>
</div>

<script src="js/reg_validation.js"></script>

<!-- Eye Toggle Script -->
<script>
document.getElementById("togglePassword").addEventListener("click", function () {
    var passwordField = document.getElementById("password");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
    }
});
</script>

</body>
</html>