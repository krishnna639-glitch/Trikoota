<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account</title>
<style>
body{
margin:0;
padding:0;
font-family: Arial, sans-serif;
background:#eaffc7;
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}
/* Card */
.container{
width:380px;
background:#e4f7d4;
padding:35px;
border-radius:12px;
box-shadow:0 0 15px rgba(0,0,0,0.1);
}
.container h2{
text-align:center;
margin-bottom:25px;
letter-spacing:1px;
}
/* Input group */
.input-group{
margin-bottom:18px;
}
.input-group label{
display:block;
font-size:14px;
margin-bottom:6px;
}
/* TEXTBOX STYLE */
.input-group input,
.input-group textarea{
width:100%;
padding:10px;
border:1px solid #999;
border-radius:5px;
font-size:14px;
outline:none;
box-sizing:border-box;
background:#fff;
}
.input-group textarea{
height:80px;
resize:none;
}
.input-group input:focus,
.input-group textarea:focus{
border-color:#4caf50;
}
/* Button */
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
/* Bottom text */
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
</style>

</head>
<body>
<div class="container">
<h2>Create Account</h2>
<form method="post" action="register.php">
<div class="input-group">
<label>Full Name</label>
<input type="text" name="name" required>
</div>
<div class="input-group">
<label>Email</label>
<input type="email" name="email" required>
</div>
<div class="input-group">
<label>Password</label>
<input type="password" name="password" required>
</div>
<div class="input-group">
<label>Phone</label>
<input type="text" name="phone" required>
</div>
<div class="input-group">
<label>Address</label>
<textarea name="address" required></textarea>
</div>
<button type="submit" name="register" class="btn">Register</button>
<div class="bottom-text">
Already have an account?
<a href="login.php">Login here</a>
</div>
</form>
</div>
</body>
</html>