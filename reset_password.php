<?php
session_start();
include "config/db.php";

if(!isset($_GET['token'])){
    die("Invalid request");
}

$token = $_GET['token'];
$current_time = date("Y-m-d H:i:s");

// Check token
$check = mysqli_query($conn,"
    SELECT * FROM userr 
    WHERE reset_token='$token' 
    AND token_expiry >= '$current_time'
");

if(mysqli_num_rows($check) == 0){
    die("Token expired or invalid");
}

$user = mysqli_fetch_assoc($check);

// RESET PASSWORD
if(isset($_POST['reset'])){
    $newpass = $_POST['password'];
    $pass = password_hash($newpass, PASSWORD_DEFAULT);

    $result = mysqli_query($conn,"
        UPDATE userr 
        SET password='$pass', reset_token=NULL, token_expiry=NULL
        WHERE U_id='{$user['U_id']}'
    ");

    if($result){
        echo "<script>alert('Password updated successfully');window.location='login.php'</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
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
</style>
</head>

<body>

<?php include "header.php"; ?>

<div class="box">
<h2>Reset Password</h2>

<form method="post">
<input type="password" name="password" placeholder="New Password" required>
<button type="submit" name="reset">Reset Password</button>
</form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>