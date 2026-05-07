<?php 
$conn = mysqli_connect("localhost", "root", "", "trikoota_db"); 
 
$message = ""; 
 
if (isset($_POST['send'])) { 
    $email = $_POST['email']; 
 
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"); 
    if (mysqli_num_rows($check) > 0) { 
 
        $token = bin2hex(random_bytes(32)); 
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes")); 
 
        mysqli_query($conn, "UPDATE users  
            SET reset_token='$token', token_expiry='$expiry'  
            WHERE email='$email'"); 
 
        // For practical – show link instead of email 
        $message = "Reset link: <br> 
        <a href='forgot_password.php?token=$token'>Click here to reset password</a>"; 
    } else { 
        $message = "Email not found!"; 
    } 
} 
 
if (isset($_POST['reset'])) { 
    $token = $_POST['token']; 
    $newpass = md5($_POST['password']); 
 
    $check = mysqli_query($conn, "SELECT * FROM users  
        WHERE reset_token='$token' AND token_expiry >= NOW()"); 
 
    if (mysqli_num_rows($check) > 0) { 
        mysqli_query($conn, "UPDATE users  
            SET password='$newpass', reset_token=NULL, token_expiry=NULL  
            WHERE reset_token='$token'"); 
 
        echo "<script>alert('Password reset successful'); window.location='login.php';</script>"; 
    } else { 
        echo "<script>alert('Link expired');</script>"; 
    } 
} 
?> 
 
<!DOCTYPE html> 
<html> 
<head> 
<title>Forgot Password</title> 
<style> 
body{ 
    background:#e9f5e9; 
    font-family:Arial; 
} 
.box{ 
    width:350px; 
    background:#fff; 
    margin:100px auto; 
    padding:30px; 
    border-radius:10px; 
    box-shadow:0 0 10px rgba(0,0,0,0.1); 
} 
h2{text-align:center;color:#2e7d32;} 
input{ 
    width:100%; 
    padding:10px; 
    margin-top:15px; 
    border:none; 
    border-bottom:2px solid #4caf50; 
    outline:none; 
} 
button{ 
    width:100%; 
    margin-top:25px; 
    padding:10px; 
    background:#4caf50; 
    border:none; 
    color:white; 
    border-radius:20px; 
    cursor:pointer; 
} 
.msg{ 
    margin-top:15px; 
    text-align:center; 
    color:green; 
    font-size:14px; 
} 
a{color:#2e7d32;text-decoration:none;} 
</style> 
</head> 
 
<body> 
 
<div class="box"> 
 
<?php if (!isset($_GET['token'])) { ?> 
<h2>Forgot Password</h2> 
<form method="post"> 
<input type="email" name="email" placeholder="Type Your Email" required> 
<button name="send">Send Reset Link</button> 
</form> 
<div class="msg"><?php echo $message; ?></div> 
<?php } else { ?> 
<h2>Reset Password</h2> 
<form method="post"> 
<input type="hidden" name="token" value="<?php echo $_GET['token']; ?>"> 
<input type="password" name="password" placeholder="New Password" required> 
<button name="reset">Reset Password</button> 
</form> 
<?php } ?> 
</div> 
</body> 
</html>