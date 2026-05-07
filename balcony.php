<?php 
session_start();
include "header.php";
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Balcony Garden | Trikoota</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 
    <style> 
        body{ 
            margin:0; 
            font-family: 'Segoe UI', sans-serif; 
            background:#f4f7f4; 
            color:#333; 
        } 
 
        /* HERO SECTION */ 
        .hero{ 
            background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), 
            url('images/balcony-garden.jpg') center/cover no-repeat; 
            padding:80px 20px; 
            text-align:center; 
            color:#fff; 
        } 
 
        .hero h1{ 
            font-size:42px; 
            margin-bottom:10px; 
        } 
 
        .hero p{ 
            font-size:18px; 
            max-width:700px; 
            margin:auto; 
        } 
 
        /* CONTAINER */ 
        .container{ 
            width:70%; 
            margin:60px auto; 
        } 
 
        /* SERVICES */ 
        .services{ 
            display:grid; 
            grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); 
            gap:25px; 
        } 
 
        .service-box{ 
            background:#fff; 
            padding:25px; 
            border-radius:12px; 
            box-shadow:0 6px 18px rgba(0,0,0,0.08); 
            text-align:center; 
            transition:0.3s; 
        } 
 
        .service-box:hover{ 
            transform:translateY(-6px); 
        } 
 
        .service-box img{ 
            width:70px; 
            margin-bottom:15px; 
        } 
 
        .service-box h3{ 
            margin-bottom:10px; 
            color:#2e7d32; 
        } 
 
        /* INFO SECTION */ 
        .info{ 
            background:#e8f5e9; 
            padding:40px; 
            border-radius:14px; 
            margin-top:60px; 
        } 
 
        .info h2{ 
            text-align:center; 
            color:#1b5e20; 
            margin-bottom:20px; 
        } 
 
        .info ul{ 
            max-width:650px; 
            margin:auto; 
            font-size:16px; 
        } 
 
        .info ul li{ 
            margin-bottom:12px; 
        } 
 
        /* CTA */ 
        .cta{ 
            text-align:center; 
            margin:60px 0; 
        } 
 
        .cta a{ 
            background:#2e7d32; 
            color:#fff; 
            padding:14px 35px; 
            border-radius:30px; 
            text-decoration:none; 
            font-size:16px; 
            transition:0.3s; 
        } 
 
        .cta a:hover{ 
            background:#1b5e20; 
        } 
 
        /* MOBILE */ 
        @media(max-width:768px){ 
            .container{ 
                width:90%; 
            } 
            .hero h1{ 
                font-size:32px; 
            } 
        } 
    </style> 
</head> 
 
<body> <!-- HERO --> 
<div class="hero"> 
    <h1>Balcony Garden Solutions</h1> 
    <p>Transform your small balcony into a refreshing green paradise with Trikoota’s expert 
balcony gardening services.</p> 
</div> 
 
<!-- SERVICES --> 
<div class="container"> 
    <div class="services"> 
        <div class="service-box"> 
            <img src="images/pot.png" alt=""> 
            <h3>Plant Selection</h3> 
            <p>Perfect plants chosen based on sunlight, space and balcony size.</p> 
        </div> 
 
        <div class="service-box"> 
            <img src="images/design.png" alt=""> 
            <h3>Garden Design</h3> 
            <p>Modern, aesthetic layouts to maximize beauty and comfort.</p> 
        </div> 
 
        <div class="service-box"> 
            <img src="images/maintenance.png" alt=""> 
            <h3>Easy Maintenance</h3> 
            <p>Low-maintenance plants and smart watering solutions.</p> 
        </div> 
 
        <div class="service-box"> 
            <img src="images/eco.png" alt=""> 
            <h3>Eco Friendly</h3> 
            <p>Sustainable gardening practices for a healthier lifestyle.</p> 
        </div> 
    </div> 
 
    <!-- INFO --> 
    <div class="info"> 
        <h2>Why Choose Trikoota?</h2> 
        <ul> 
            <li>
🌿
 Customized balcony garden solutions</li> 
            <li>
🌿
 Expert guidance & plant care tips</li> 
            <li>
🌿
 Affordable packages</li> 
            <li>
🌿
 Suitable for homes & apartments</li> 
            <li>
🌿
 Fresh, healthy & peaceful environment</li> 
        </ul> 
    </div> 
 
    <!-- CTA --> 
    <div class="cta"> 
        <a href="contact.php">Book Your Balcony Garden</a> 
    </div> 
</div> 
 <?php include "footer.php"; ?>
</body> 
</html>