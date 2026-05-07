<?php
include "config/db.php";
include "header.php";

$msg = "";

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $check = mysqli_query($conn,"SELECT * FROM userr WHERE U_email='$email'");
    if(mysqli_num_rows($check) > 0){

        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

        mysqli_query($conn,"
            UPDATE userr 
            SET reset_token='$token', token_expiry='$expiry'
            WHERE U_email='$email'
        ");

        // 🔴 For localhost/testing (no mail)
        $reset_link = "http://localhost/trikoota/reset_password.php?token=$token";

        $msg = "Reset link: <a href='$reset_link'>Click here to reset password</a>";
    } else {
        $msg = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<style>
body{font-family:Arial;background:#f4f6f3}
.box{
    width:400px;margin:100px auto;background:#fff;
    padding:30px;border-radius:10px;
}
input,button{
    width:100%;padding:12px;margin-top:10px;
}
button{background:#2e7d32;color:#fff;border:none}
.msg{margin-top:15px;color:green}
</style>
</head>

<body>
<div class="box">
<h2>Forgot Password</h2>

<form method="post">
<input type="email" name="email" placeholder="Enter your email" required>
<button name="submit">Send Reset Link</button>
</form>

<div class="msg"><?php echo $msg; ?></div>
</div>
<?php include 'footer.php';?>
</body>
</html>
