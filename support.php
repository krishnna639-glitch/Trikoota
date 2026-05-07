<?php
session_start();
include "config/db.php";
include "header.php";
if(isset($_POST['send']))
{
    // Check if user is logged in
    if(!isset($_SESSION['uid']))
    {
        echo "<script>
                alert('Please login first');
                window.location.href='login.php';
              </script>";
        exit();
    }

    $U_id = $_SESSION['uid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $query = "INSERT INTO messages (U_id, name, email, subject, message) 
              VALUES ('$U_id','$name', '$email', '$subject', '$message')";

    if(mysqli_query($conn, $query))
    {
        echo "<script>alert('Message sent successfully');</script>";
    }
    else{
        echo "Insert Error:".mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Support | Trikoota</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    * { 
    margin: 0; 
    padding: 0; 
    box-sizing: border-box; 
    font-family: Arial, sans-serif; 
} 
 
.support-section { 
    padding: 60px 10%; 
    background: #ffffff; 
} 
 
.support-container { 
    display: flex; 
    gap: 60px; 
} 
 
/* LEFT FORM */ 
.support-form { 
    flex: 2; 
} 
 
.support-form h2 { 
    font-size: 28px; 
    margin-bottom: 25px; 
} 
 
.support-form input, 
.support-form textarea { 
    width: 100%; 
    padding: 12px; 
    margin-bottom: 15px; 
    border: 1px solid #ccc; 
    outline: none; 
    font-size: 14px; 
} 
 
.support-form button { 
    background: #1f2b37; 
    color: #fff; 
    padding: 12px 30px; 
    border: none; 
    cursor: pointer; 
    font-size: 14px; 
} 
 
.support-form button:hover { 
    background: #2e3e4e; 
} 
 
.captcha-text { 
    font-size: 12px; 
    color: #777; 
    margin-top: 10px; 
} 
 
.captcha-text a { 
    color: #555; 
    text-decoration: none; 
} 
 
/* RIGHT INFO */ 
.support-info { 
    flex: 1; 
} 
 
.support-info h3 { 
    font-size: 16px; 
    margin-top: 20px; 
    margin-bottom: 5px; 
} 
 
.support-info p { 
    font-size: 14px; 
    color: #555; 
} 
 
/* SOCIAL ICONS */ 
.social-icons { 
    margin-top: 10px; 
} 
 
.social-icons i { 
    margin-right: 12px; 
    font-size: 16px; 
    cursor: pointer; 
    color: #333; 
} 
 
.social-icons i:hover { 
    color: #3ba66b; 
} 
 
/* RESPONSIVE */ 
@media (max-width: 900px) { 
    .support-container { 
        flex-direction: column; 
    } 
}
</style>
</head>
<body>
    <?php if(!isset($_SESSION['uid'])) { ?>
    <p style="color:red; font-weight:bold;">
        Please <a href="login.php">login</a> to send a message.
    </p>
<?php } ?>
 <!-- SUPPORT SECTION --> 
<section class="support-section"> 
    <div class="support-container"> 
        
        <!-- LEFT FORM --> 
        <div class="support-form"> 
            <h2>Get in touch</h2> 
 
            <form method="POST" action=""> 
               <input type="text" placeholder="Name" name="name" 
value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>

<input type="email" placeholder="Email" name="email" 
value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
                <input type="text" name="subject" placeholder="Subject" required> 
                <textarea name="message" placeholder="type your message" rows="5"></textarea> 
 
                <button type="submit" name="send">SEND MESSAGE</button> 
            </form> 
 
            <p class="captcha-text"> 
                This site is protected by reCAPTCHA and the Google 
                <a href="#">Privacy Policy</a> and 
                <a href="#">Terms of Service</a> apply. 
            </p> 
        </div> 
 
        <!-- RIGHT INFO --> 
        <div class="support-info"> 
            <h3>Information</h3> 
            <p>info@trikoota.com</p> 
 
            <h3>Care</h3> 
            <p>care@trikoota.com</p> 
 
            <h3>Mobile</h3> 
            <p>+91 87994 94182</p> 
 
            <h3>Office time</h3> 
            <p>10:00 AM - 6:00 PM (Mon-Sat)</p> 
 
            <h3>Follow us</h3> 
            <div class="social-icons"> 
                <i class="fab fa-facebook-f"></i> 
                <i class="fab fa-x-twitter"></i> 
                <i class="fab fa-pinterest-p"></i> 
                <i class="fab fa-instagram"></i> 
                <i class="fab fa-linkedin-in"></i> 
                <i class="fab fa-youtube"></i> 
            </div> 
        </div> 
 
    </div> 
</section> 
<?php include "footer.php"; ?>
</body> 
</html>