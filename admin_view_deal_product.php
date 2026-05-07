<?php
include 'config/db.php';
include 'admin_header.php';

$data = mysqli_query($conn,
    "SELECT dp.id,
            d.deal_code,
            d.deal_type,
            d.deal_value,
            p.name,
            p.price
     FROM deal_products dp
     JOIN deals d ON dp.deal_id = d.id
     JOIN products p ON dp.product_id = p.id
     ORDER BY d.deal_code"
);
?>
<html>
<head>
<link rel="stylesheet" href="css/admin_view_deal_product.css">

</head>
<body>

<div class="container">
    <h2>Deals Applied on Products</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Deal Name</th>
            <th>Discount</th>
            <th>Product</th>
            <th>Original Price</th>
        </tr>

        <?php if(mysqli_num_rows($data)>0){ 
            while($row=mysqli_fetch_assoc($data)){ ?>
        <tr>
            <td><?= $row['deal_code'] ?></td>
            <td>
                <?= $row['deal_value'] ?>
                <?= $row['deal_type']=='percentage'?'%':'₹' ?>
            </td>
            <td><?= $row['name'] ?></td>
            <td>₹<?= $row['price'] ?></td>
        </tr>
        <?php } } else { ?>
        <tr>
            <td colspan="4">No deals assigned yet</td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php include 'admin_footer.php'; ?>
</body>
</html>
