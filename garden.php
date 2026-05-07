<?php 
session_start();
include "header.php";
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<title>Garden Maintenance | Trikoota</title> 
 
<style> 
body{ 
    margin:0; 
    font-family:"Segoe UI", Arial, sans-serif; 
    background:#ffffff; 
    color:#444; 
} 
 
.container{ 
    width:80%; 
    margin:50px auto; 
} 
 
h1{ 
    font-size:36px; 
    color:#2f6b3f; 
    margin-bottom:15px; 
} 
 
h2{ 
    font-size:24px; 
    color:#2f6b3f; 
    margin-top:35px; 
    margin-bottom:15px; 
} 
 
p{ 
    font-size:16px; 
    line-height:1.8; 
    margin-bottom:15px; 
} 
 
ul{ 
    list-style:none; 
    padding-left:0; 
} 
 
ul li{ 
    font-size:16px; 
    margin-bottom:12px; 
    padding-left:28px; 
    position:relative; 
} 
 
ul li::before{ 
    content:"✔"; 
    color:#2f6b3f; 
    position:absolute; 
    left:0; 
} 
 
.service-box{ 
    background:#f4f9f5; 
    padding:25px; 
    border-left:5px solid #2f6b3f; 
    margin-bottom:25px; 
} 
 
.note{ 
    font-style:italic; 
    color:#666; 
} 
</style> 
</head> 
 
<body>  
<div class="container"> 
 
    <h1>Garden Maintenance Services</h1> 
    <p> 
        At <strong>Trikoota</strong>, we provide professional garden maintenance 
        services to keep your plants healthy, green, and beautiful throughout the year. 
        Our experts ensure proper care for your garden with eco-friendly practices. 
    </p> 
 
    <div class="service-box"> 
        <h2>Our Maintenance Services</h2> 
        <ul> 
            <li>Regular watering and irrigation planning</li> 
            <li>Soil testing and nutrient management</li> 
            <li>Pruning and trimming of plants</li> 
            <li>Weed control and garden cleaning</li> 
            <li>Seasonal plant care and replacement</li> 
        </ul> 
    </div> 
 
    <h2>Why Garden Maintenance is Important</h2> 
    <ul> 
        <li>Improves plant growth and longevity</li> 
        <li>Prevents plant diseases and pests</li> 
        <li>Enhances the beauty of your space</li> 
        <li>Ensures a healthy and eco-friendly environment</li> 
    </ul> 
 
    <h2>Who Can Use This Service?</h2> 
    <ul> 
        <li>Home gardens</li> 
        <li>Balconies and terrace gardens</li> 
        <li>Office and commercial spaces</li> 
        <li>Societies and public gardens</li> 
    </ul> 
 
    <h2>Maintenance Schedule</h2> 
    <p> 
        We offer flexible maintenance plans including: 
    </p> 
    <ul> 
        <li>Weekly garden maintenance</li> 
        <li>Monthly garden maintenance</li> 
        <li>Customized plans based on garden size</li> 
    </ul> 
 
    <h2>Book Garden Maintenance</h2> 
    <p> 
        To book our garden maintenance service, contact our support team or 
        place a service request through your Trikoota account. 
    </p> 
 
    <p class="note"> 
        Note: Service availability may vary based on location and garden size. 
    </p> 
 
</div> 
 
<?php include "footer.php"; ?> 
 
</body> 
</html>