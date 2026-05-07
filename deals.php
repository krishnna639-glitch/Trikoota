<?php
session_start();
include 'config/db.php';
include 'header.php';
// Fetch active deals with products
$sql = "
SELECT 
    p.id,
    p.name,
    p.price,
    p.image,
    d.deal_title,
    d.deal_type,
    d.deal_value
FROM deals d
JOIN deal_products dp ON d.id = dp.deal_id
JOIN products p ON dp.product_id = p.id
WHERE d.status = 'active'
AND CURDATE() BETWEEN d.valid_from AND d.valid_till
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<title>🔥 Deals & Offers</title>

<style>
body{
    background:#f3f7f2;
    font-family: Arial, sans-serif;
}

.deals-container{
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}

.deals-title{
    text-align:center;
    font-size:32px;
    color:#2e7d32;
    margin-bottom:30px;
}

.deals-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
    gap:30px;
}

.deal-card{
    background:white;
    border-radius:15px;
    padding:15px;
    box-shadow:0 8px 20px rgba(0,0,0,0.12);
    transition:.3s;
    position:relative;
}

.deal-card:hover{
    transform:translateY(-5px);
}

.deal-badge{
    position:absolute;
    top:12px;
    left:12px;
    background:#e53935;
    color:white;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}

.deal-card img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-radius:12px;
}

.deal-card h4{
    margin:15px 0 8px;
    color:#2e7d32;
}

.price-box{
    margin:10px 0;
}

.price-box del{
    color:#999;
    margin-right:8px;
}

.price-box span{
    color:#e53935;
    font-size:18px;
    font-weight:bold;
}

.deal-title{
    font-size:14px;
    color:#555;
    margin-bottom:12px;
}

.btn{
    display:block;
    text-align:center;
    padding:12px;
    background:#2e7d32;
    color:white;
    text-decoration:none;
    border-radius:8px;
    transition:.3s;
}

.btn:hover{
    background:#1b5e20;
}
</style>
</head>

<body>

<div class="deals-container">
    <div class="deals-title">🔥 Today’s Green Deals</div>

    <div class="deals-grid">

    <?php if(mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_assoc($result)){

            // Calculate discounted price
            if($row['deal_type'] == 'percentage'){
                $discounted_price = $row['price'] - 
                    ($row['price'] * $row['deal_value'] / 100);
            }else{
                $discounted_price = $row['price'] - $row['deal_value'];
            }
    ?>
        <div class="deal-card">
            <div class="deal-badge">
                <?php echo $row['deal_type']=='percentage'
                    ? $row['deal_value'].'% OFF'
                    : '₹'.$row['deal_value'].' OFF'; ?>
            </div>

            <img src="uploads/<?php echo $row['image']; ?>" alt="Product">

            <h4><?php echo $row['name']; ?></h4>

            <div class="deal-title"><?php echo $row['deal_title']; ?></div>

            <div class="price-box">
                <del>₹<?php echo number_format($row['price'],2); ?></del>
                <span>₹<?php echo number_format($discounted_price,2); ?></span>
            </div>

            <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn">
                Add to Cart
            </a>
        </div>
    <?php } } else { ?>
        <p style="grid-column:1/-1; text-align:center; font-size:18px;">
            No deals available right now 🌱
        </p>
    <?php } ?>

    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
