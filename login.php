<?php
$error = "";
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
include "config/db.php";

if(isset($_POST['login']))
{
    $username= mysqli_real_escape_string($conn,$_POST['username']);
    $pass=$_POST['password'];
    $query = "SELECT * FROM userr WHERE U_name='$username' LIMIT 1";
    $result = mysqli_query($conn , $query);

    if($result && mysqli_num_rows($result) === 1)
    {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($pass,$user['password']))
        {
            $_SESSION['uid']=$user['U_id'];
            $_SESSION['username']=$user['U_name']; 
            $_SESSION['role']=$user['R__id'];

            if($user['R__id'] == 1)
            {
                echo "<script>
                        alert('Welcome Admin!');
                        window.location.href='trikoota_user.php';
                      </script>";
            }
            else
            {
                echo "<script>
                        alert('Welcome user!');
                        window.location.href='trikoota_user.php';
                      </script>";
            }
            exit();
        }
        else
        {
            echo "<script> alert('Invalid Password! Please try again.');</script>";
        }
    }
    else
    {
        header("Location: register.php?msg=not_registered");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta charset="UTF-8">
<title>Login</title>

<link rel="stylesheet" href="css/style.css">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif;}
body{margin:0;min-height:100vh;background:url("images/login1.jpg") no-repeat center center;background-size:cover;animation:fadeIn 1s ease;}
.login-wrapper{margin-top:120px;display:flex;justify-content:center;z-index:999;width:100%;}
.login-box{width:380px;background:#c6dbb5ff;padding:35px;border-radius:10px;text-align:center;box-shadow:0 10px 40px rgba(0,0,0,0.25);animation:slideUp 1s ease;}
.login-box h2{margin-bottom:30px;color:#2f2f2f;letter-spacing:1px;}
.input-group{margin-bottom:20px;text-align:left;position:relative;}
.input-group label{font-size:14px;color:#333;}
.input-field{display:flex;align-items:center;border-bottom:2px solid #9dbb7d;margin-top:5px;}
.input-field i{color:#4b7a1d;margin-right:0px;}
.input-field input{width:100%;border:none;outline:none;background:transparent;padding:8px 4px;font-size:14px;}
.forgot{text-align:right;font-size:12px;margin-top:-10px;}
.forgot a{text-decoration:none;color:#444;}
.login-btn{margin:25px 0;}
.login-btn button{padding:10px 40px;border:none;border-radius:20px;background:#b7b7b7;color:#000;font-size:16px;cursor:pointer;}
.register-btn button{padding:10px 40px;border:none;border-radius:20px;background:#b7b7b7;color:#000;font-size:16px;cursor:pointer;}
@keyframes fadeIn{from{opacity:0;transform:translateY(30px);}to{opacity:1;transform:translateY(0);}}
@keyframes slideUp{from{opacity:0;transform:translateY(50px);}to{opacity:1;transform:translateY(0);}}
input{transition:0.3s;}
input:focus{border:2px solid #2ecc71;box-shadow:0 0 10px #2ecc71;}
button{background:#2ecc71;color:white;padding:10px;border:none;transition:0.4s;cursor:pointer;}
button:hover{background:#219150;transform:scale(1.05);}
</style>
</head>
<body>

<?php include "header.php"; ?>

<div class="login-wrapper">
<div class="login-box">
<h2>LOGIN</h2>

<p style="color:red; text-align:center;">
<?php echo $error; ?>
</p>

<form method="POST" action="login.php">

<div class="input-group">
<label>Username</label>
<div class="input-field">
<i class="fa fa-user"></i>
<input type="text" name="username" placeholder="Type Your Username" required>
</div>
</div>

<div class="input-group">
<label>Password</label>
<div class="input-field">
<i class="fa fa-lock"></i>
<input type="password" id="loginPassword" name="password" placeholder="Type Your Password" required>
<i class="fa fa-eye" id="togglePassword" style="cursor:pointer; margin-left:10px;"></i>
</div>
</div>

<div class="forgot">
<a href="forgot_password.php">Forgot Password ?</a>
</div>

<div class="login-btn">
<button type="submit" name="login">Login</button>
</div>

<div class="register-btn">
<p>New User? <a href="register.php">Register</a></p>
</div>

</form>
</div>
</div>

<?php include 'footer.php'; ?>

<script>
document.getElementById("togglePassword").addEventListener("click", function () {
    var passwordField = document.getElementById("loginPassword");

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