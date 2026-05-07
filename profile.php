<?php 
session_start();
if(!isset($_SESSION['U_id']))
{
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Profile👤</title>
        <style>
            body{
                font-family:Arial;
                background:#e8f5e9;
            }
            .profile-card{
                width:400px;
                background:#fff;
                padding:25px;
                margin:80px auto;
                border-radius:10px;
                box-shadow:0 5px 15px rgba(0,0,0,0.15);
                text-align:center;
            }
            .profile-card h2{
                color:#2e7d32;
            }
            .profile-card a{
                display:inline-block;
                margin-top:20px;
                padding:10px 20px;
                background:#2e7d32;
                color:white;
                text-decoration:none;
                border-radius:5px;
            }
        </style>
    </head>
    <body>
        <?php include 'index.php';?>
        <div class="profile-card">
                <h2>My profile</h2>
                <p><b>Name:</b><?php echo $_SESSION['U_name'];?></p>
                <p><b>Email:</b><?php echo $_SESSION['U_email'];?></p>
                <a href="index.php">Go to Home<a>
                <a href="logout.php">Logout</a>
        </div>
    </body>
</html>