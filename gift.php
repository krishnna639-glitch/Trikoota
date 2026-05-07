<?php 
session_start();
include "header.php";
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<title>Corporate Gifting | Trikoota</title> 
 
<style> 
body{ 
    margin:0; 
    font-family:"Segoe UI", Arial, sans-serif; 
    background:#ffffff; 
    color:#444; 
} 
 
/* HERO SECTION */ 
.hero{ 
    background:linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)), 
    url('images/corporate-gifting.jpg') center/cover no-repeat; 
    padding:60px 20px; 
    text-align:center; 
    color:#fff; 
} 
 
.hero h1{ 
    font-size:42px; 
    margin-bottom:15px; 
} 
 
.hero p{ 
    font-size:18px; 
    max-width:700px; 
    margin:auto; 
} 
 
/* MAIN CONTAINER */ 
.container{ 
    width:70%; 
    margin:40px auto; 
} 
 
/* SECTION HEADINGS */ 
.section-title{ 
    text-align:center; 
    margin-bottom:40px; 
} 
 
.section-title h2{ 
    font-size:32px; 
    color:#2f6b3f; 
    margin-bottom:10px; 
} 
 
.section-title p{ 
    color:#666; 
} 
 
/* CARDS */ 
.cards{ 
    display:grid; 
    grid-template-columns:repeat(auto-fit, minmax(220px,1fr)); 
    gap:25px; 
} 
 
.card{ 
    background:#f6fbf7; 
    padding:18px; 
    border-radius:12px; 
    box-shadow:0 5px 15px rgba(0,0,0,0.08); 
    transition:0.4s; 
    position:relative; 
    overflow:hidden; 
} 
 
.card:hover{ 
    transform:translateY(-8px); 
} 
 
.card h3{ 
    color:#2f6b3f; 
    margin-bottom:12px; 
} 
 
.card p{ 
    font-size:15px; 
    line-height:1.6; 
} 
 
/* ICON CIRCLE */ 
/* .icon{ 
    width:60px; 
    height:60px; 
    background:#2f6b3f; 
    color:#fff; 
    display:flex; 
    align-items:center; 
    justify-content:center; 
    border-radius:50%; 
    font-size:26px; 
    margin-bottom:15px; 
}  */
 
/* WHY CHOOSE US */ 
.why{ 
    background:#eef7f0; 
    padding:60px 20px; 
    margin-top:70px; 
} 
 
.why ul{ 
    max-width:800px; 
    margin:30px auto; 
    list-style:none; 
    padding:0; 
} 
 
.why li{ 
    font-size:17px; 
    margin-bottom:14px; 
    padding-left:30px; 
    position:relative; 
} 
 
.why li::before{ 
    content:"
🌿
"; 
    position:absolute; 
    left:0; 
} 
 
/* CTA */ 
.cta{ 
    background:#2f6b3f; 
    color:#fff; 
    text-align:center; 
    padding:70px 20px; 
    margin-top:70px; 
} 
 
.cta h2{ 
    font-size:34px; 
    margin-bottom:15px; 
} 
 
.cta p{ 
    font-size:18px; 
    margin-bottom:25px; 
} 
 
.cta a{ 
    background:#fff; 
    color:#2f6b3f; 
    padding:14px 35px; 
    text-decoration:none; 
    font-weight:bold; 
    border-radius:30px; 
    transition:0.3s; 
} 
 
.cta a:hover{ 
    background:#e4f3e8; 
} 
 
/* RESPONSIVE */ 
@media(max-width:768px){ 
    .hero h1{font-size:32px;} 
} 
</style> 
</head> 
 
<body> 
 
 
<!-- HERO --> 
<div class="hero"> 
    <h1>Corporate Gifting with Trikoota</h1> 
    <p> 
        Eco-friendly plant gifts that leave a lasting impression. 
        Perfect for employees, clients, and business partners. 
    </p> 
</div> 
 
<!-- INTRO --> 
<!-- <div class="container">  -->
    <div class="section-title"> 
        <h2>Green Gifts for Corporate Relationships</h2> 
        <p> 
            Trikoota offers premium corporate gifting solutions using plants and 
            eco-friendly products that symbolize growth, care, and sustainability. 
        </p> 
    <!-- </div>  -->
 
    <!-- CARDS --> 
    <div class="cards"> 
        <div class="card"> 
            <div class="icon">
🎁
</div> 
            <h3>Employee Gifting</h3> 
            <p> 
                Welcome kits, festival gifts, and appreciation plants that 
                motivate and inspire employees. 
            </p> 
        </div> 
 
        <div class="card"> 
            <div class="icon">
🏢
</div> 
            <h3>Client Gifting</h3> 
            <p> 
                Impress your clients with elegant green gifts that reflect 
                your brand values. 
            </p> 
        </div> 
 
        <div class="card"> 
            <div class="icon">
🌱
</div> 
            <h3>Eco-Friendly Gifts</h3> 
            <p> 
                Sustainable plant-based gifting options that support 
                environmental responsibility. 
            </p> 
        </div> 
 
        <div class="card"> 
            <div class="icon">
✨
</div> 
            <h3>Customized Branding</h3> 
            <p> 
                Personalized pots, tags, and gift packaging with your 
                company branding. 
            </p> 
        </div> 
    </div> 
</div> 
 
<!-- WHY CHOOSE US --> 
<div class="why"> 
    <div class="section-title"> 
        <h2>Why Choose Trikoota?</h2> 
        <p>We combine sustainability with style and reliability</p> 
    </div> 
 
    <ul> 
        <li>Premium quality plants with expert care</li> 
        <li>Bulk order support and timely delivery</li> 
        <li>Custom packaging and branding options</li> 
        <li>Eco-conscious gifting solutions</li> 
        <li>Dedicated corporate support team</li> 
    </ul> 
</div> 
 
<!-- CTA --> 
<div class="cta"> 
    <h2>Let’s Grow Your Corporate Relationships</h2> 
    <p>Contact us today for bulk orders and custom corporate gifting solutions.</p> 
    <a href="contact.php">Get in Touch</a> 
</div> 
 
<?php include "footer.php"; ?> 
 
</body> 
</html>