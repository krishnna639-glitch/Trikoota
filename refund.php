<?php 
session_start();
include "header.php";
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<title>Return & Refund Policy | Trikoota</title> 
 
<style> 
body{ 
    margin:0; 
    font-family: "Segoe UI", Arial, sans-serif; 
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
    margin-bottom:10px; 
} 
 
p{ 
    font-size:16px; 
    line-height:1.8; 
} 
 
.section{ 
    margin-top:40px; 
} 
 
.section h2{ 
    font-size:22px; 
    color:#2f6b3f; 
    margin-bottom:15px; 
} 
 
ul{ 
    padding-left:0; 
    list-style:none; 
} 
 
ul li{ 
    font-size:16px; 
    padding-left:28px; 
    margin-bottom:12px; 
    position:relative; 
} 
 
ul li::before{ 
    content:"✔"; 
    color:#2f6b3f; 
    font-weight:bold; 
    position:absolute; 
    left:0; 
} 
 
.note{ 
    font-style:italic; 
    color:#666; 
    margin-top:10px; 
} 
 
.highlight{ 
    font-weight:600; 
} 
</style> 
</head> 
 
<body> 
 
<div class="container"> 
 
    <h1>Return & Refund Policies</h1> 
    <p> 
        At Trikoota, we care about your satisfaction and always aim to deliver 
        fresh, healthy, and high-quality products. However, we understand that 
        there might be situations where you need a refund or replacement. 
    </p> 
 
    <!-- SECTION 1 --> 
    <div class="section"> 
        <h2>1. Eligible for Refund with Return</h2> 
        <p>If the product is delivered:</p> 
 
        <ul> 
            <li>Do not like the product</li> 
            <li>No longer want it</li> 
            <li>Ordered by mistake</li> 
        </ul> 
 
        <p class="highlight">You are still allowed to return it under the following conditions:</p> 
 
        <ul> 
            <li>The return request must be made within 7 days of delivery</li> 
            <li>The product must be unused and in the same condition as delivered</li> 
        </ul> 
    </div> 
 
    <!-- SECTION 2 --> 
    <div class="section"> 
        <h2>2. Eligible for Refund or Replacement Without Return</h2> 
 
        <ul> 
            <li>The product arrives damaged or defective</li> 
            <li>The product is not in usable condition due to transit damage</li> 
            <li>The wrong product is delivered</li> 
        </ul> 
 
        <p class="note"> 
            (Note: Slight variations in color, natural plant shape, or plants delivered without 
flowers are normal and not considered wrong products.) 
        </p> 
 
        <p> 
            Since our products are perishable, we do not ask for returns in such cases. 
        </p> 
    </div> 
 
    <!-- SECTION 3 --> 
    <div class="section"> 
        <h2>Procedure for Replacement or Refund</h2> 
 
        <p> 
            Send us photos of damaged plants through the registered email ID to: 
            <strong>support@trikoota.com</strong> 
        </p> 
 
        <ul> 
            <li>Plant name, damaged parts, and Trikoota sticker must be visible in one photo</li> 
            <li>Images must be shared within 24 hours of delivery</li> 
            <li>If details cannot be captured in one photo, send a video (max 20 seconds)</li> 
        </ul> 
 
        <p> 
            After verification, our team will decide whether the case qualifies 
            for refund or replacement. Replacement will be prioritized. 
        </p> 
 
        <p> 
            Refunds take up to <strong>5 working days</strong> to reflect in the original 
payment method. 
        </p> 
 
        <p> 
            Replacement delivery may take <strong>7–10 working days</strong>. 
        </p> 
    </div> 
 
    <!-- SECTION 4 --> 
    <div class="section"> 
        <h2>3. Cancellation</h2> 
 
        <ul> 
            <li>Customer can cancel the order before dispatch by emailing support</li> 
            <li>Customer can call support between 10:00 AM – 6:00 PM (excluding Sundays & 
Holidays)</li> 
        </ul> 
    </div> 
 
</div> 
 
<?php include "footer.php"; ?> 
 
</body> 
</html>