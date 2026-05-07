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
            // $_SESSION['user_id']=$user['U_id'];
            $_SESSION['uid']=$user['U_id'];
            $_SESSION['username']=$user['U_name']; 
            $_SESSION['role']=$user['R__id'];

            if($user['R__id'] == 1)
            {
                header("Location: /trikoota_new/admin/a_dashboard.php");
                
            }
            else
            {
                header("Location: /trikoota_new/final_mpage.php");
                
            }
            exit();
        }
        else
        {
            // $error = "Invalid Password!";
            echo "<script> alert('Invalid Password! Please try again.');</script>";
        }
    }
    else
    {
        // $error = "Username not registered!";
        header("Location: register.php? msg=not_registered");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <link rel="stylesheet" href="css/style.css">
    <style>
    *
         {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin:0;
            height: 100vh;
            background: url("images/login.jpg")no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top:100px;
        }
        .trikoota-navbar{
            position:fixed !important;
            top:0 !important;
            left:0 !important;
            /* display:flex !important;
            align-items:center;
            justify-content:space-between; */
            /* transform:translateX(-100%) !important; */
            width:100% !important;
            z-index:9999;
            /* border-radius:12px;
            background:linear-gradient(to right, #a8e6a3 , #7ed6a2) */
        }
        /* .nav-links a{
             margin-left: 20px;
            text-decoration: none;
            font-size: 18px;
            color:white;
            font-weight: 600;
        } */

        .login-wrapper{
            position:fixed;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%);
            z-index:999;
            width:100%;
            display:flex;
            justify-content:center;
        }

        .login-box {
            margin-top:100px;
            width: 380px;
            background: #c6dbb5ff;
            padding: 35px;
            border-radius: 10px;
            text-align: center;
            top:55% !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.25);
        }

        .login-box h2 {
            margin-bottom: 30px;
            color: #2f2f2f;
            letter-spacing: 1px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
            position:relative;
        }

        .input-group label {
            font-size: 14px;
            color: #333;
        }

        .input-field {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #9dbb7d;
            margin-top: 5px;
        }

        .input-field i {
            color: #4b7a1d;
            margin-right: 0px;
        }

        .input-field input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            padding: 8px 4px;
            font-size: 14px;
        }

        .forgot {
            text-align: right;
            font-size: 12px;
            margin-top: -10px;
        }

        .forgot a {
            text-decoration: none;
            color: #444;
        }

        .login-btn {
            margin: 25px 0;
        }

        .login-btn button {
            padding: 10px 40px;
            border: none;
            border-radius: 20px;
            background: #b7b7b7;
            color: #000;
            font-size: 16px;
            cursor: pointer;
        }

        .or-text {
            font-size: 13px;
            margin-bottom: 15px;
            color: #333;
        }

        .social-icons {
            margin-bottom: 20px;
        }

        .social-icons i {
            font-size: 30px;
            margin: 0 10px;
            cursor: pointer;
        }

        .fa-google { color: #db4437; }
        .fa-facebook { color: #1877f2; }
        .fa-twitter { color: #1da1f2; }

        .register-btn button {
            padding: 10px 40px;
            border: none;
            border-radius: 20px;
            background: #b7b7b7;
            color: #000;
            font-size: 16px;
            cursor: pointer;
        }
        /* Page fade in */ 
@keyframes fadeIn { 
    from { opacity: 0; transform: translateY(30px); } 
    to { opacity: 1; transform: translateY(0); } 
} 
 
body { 
    animation: fadeIn 1s ease; 
    /* background: linear-gradient(to right, #e8f5e9, #ffffff);  */
    background: url("images/login1.jpg")no-repeat center center;
    background-size: cover;
} 
 
/* Login box animation */ 
.login-box { 
    animation: slideUp 1s ease; 
} 
 
@keyframes slideUp { 
    from { opacity: 0; transform: translateY(50px); } 
    to { opacity: 1; transform: translateY(0); } 
} 
 
/* Input glow */ 
input { 
    transition: 0.3s; 
} 
 
input:focus { 
    border: 2px solid #2ecc71; 
    box-shadow: 0 0 10px #2ecc71; 
} 
 
/* Button animation */ 
button { 
    background: #2ecc71; 
    color: white; 
    padding: 10px; 
    border: none; 
    transition: 0.4s; 
    cursor: pointer; 
} 
 
button:hover { 
    background: #219150; 
    transform: scale(1.05); 
}
    </style>
</head> 
<?php include "header.php"; ?>
<body>

<?php include "header.php"; ?>
<div class="login-wrapper">
<div class="login-box">
    <h2>LOGIN</h2>
    <p style="color:red; text-align:center;">
        <?php echo $error; ?>
    </p>
    <form method="POST" action="login.php" >
        <div class="input-group">
            <label>Username</label>
            <div class="input-field">
                <i class="fa fa-user"></i>
                <input type="username"  name="username" placeholder="Type Your Username" required>
            </div>
        </div>
        <div class="input-group">
            <label>Password</label>
            <div class="input-field">
                <i class="fa fa-lock"></i>
                <input type="password"  name="password" placeholder="Type Your Password" required>
            </div>
        </div>
        <div class="forgot">
            <a href="f_password.php">Forgot Password ?</a>
        </div>
        <div class="login-btn">
            <button type="submit" name="login">Login</button>
        </div>
        <div class="or-text">Or Sign up Using</div>
        <div class="social-icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-twitter"></i>
        </div>
        
        <div class="register-btn">
            <p>New User? <a href="register.php">Register</a></p>
        </div>
    </form>
    </div>
</div>
</div>
    <!-- <script src="js/l_validation.js"></script> -->
</body>
</html>


