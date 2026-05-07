<?php
session_start();
include 'config/db.php';
include 'admin_header.php';

/* FETCH ACTIVE DEALS */
$deals = mysqli_query($conn,"SELECT * FROM deals WHERE status='active'");

/* FETCH CATEGORIES */
$categories = mysqli_query($conn,"SELECT * FROM categories");

/* ASSIGN DEAL */
if(isset($_POST['assign'])){

    $deal_id     = (int)$_POST['deal_id'];
    $category_id = (int)$_POST['category_id'];
    $product_id  = $_POST['product_id'];

    if($product_id == 'all'){

        $prods = mysqli_query($conn,"SELECT id FROM products WHERE categories_id=$category_id");

        while($p=mysqli_fetch_assoc($prods)){
            mysqli_query($conn,"
            INSERT IGNORE INTO deal_products (deal_id,product_id)
            VALUES ($deal_id,{$p['id']})
            ");
        }

        $msg="Deal applied to ALL products!";

    }else{

        mysqli_query($conn,"
        INSERT IGNORE INTO deal_products (deal_id,product_id)
        VALUES ($deal_id,$product_id)
        ");

        $msg="Deal assigned successfully!";
    }
}
/* SHOW ALL ASSIGNED DEALS */
$assigned = mysqli_query($conn,
    "SELECT dp.id, d.deal_code, p.name AS product_name
     FROM deal_products dp
     JOIN deals d ON dp.deal_id = d.id
     JOIN products p ON dp.product_id = p.id"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Assign Deal</title>

<style>
body{
    background:#f5f7f6;
    font-family:Arial;
}

.card{
    width:700px;
    margin:60px auto;
    background:white;
    padding:40px;
    border-radius:16px;
    box-shadow:0 6px 20px rgba(0,0,0,.08);
}

h2{
    text-align:center;
    color:#2e7d32;
    font-size:28px;
    margin-bottom:30px;
}

label{
    font-weight:600;
    margin-top:15px;
    display:block;
}

select{
    width:100%;
    padding:12px;
    margin-top:6px;
    border-radius:6px;
    border:1px solid #ccc;
    font-size:15px;
}

button{
    width:100%;
    margin-top:25px;
    padding:14px;
    border:none;
    background:#2e7d32;
    color:white;
    font-size:17px;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#1b5e20;
}

.msg{
    text-align:center;
    color:green;
    font-weight:bold;
    margin-bottom:15px;
}
.container{
    width:900px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:12px;
}
table{
    width:100%;
    margin-top:30px;
    border-collapse:collapse;
}
th, td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}
th{
    background:#2e7d32;
    color:#fff;
}

</style>

</head>

<body>

<div class="card">

<h2>🎯 Assign Deal to Product</h2>

<?php if(isset($msg)) echo "<div class='msg'>$msg</div>"; ?>

<form method="post">

<label>Select Deal</label>
<select name="deal_id" required>
<option value="">-- Select Deal --</option>
<?php while($d=mysqli_fetch_assoc($deals)){ ?>
<option value="<?=$d['id']?>"><?=$d['deal_code']?></option>
<?php } ?>
</select>

<label>Select Category</label>
<select name="category_id" id="category" required>
<option value="">-- Select Category --</option>
<?php while($c=mysqli_fetch_assoc($categories)){ ?>
<option value="<?=$c['categories_id']?>"><?=$c['category_name']?></option>
<?php } ?>
</select>

<label>Select Product</label>
<select name="product_id" id="product" required>
<option value="">-- Select Product --</option>
<option value="all">-- All Products --</option>
</select>

<button name="assign">Assign Deal</button>
</form>
<h2 style="margin-top:40px;">📋 Running Deal Assignments</h2>

<table>
<tr>
    <th>Deal Name</th>
    <th>Product</th>
</tr>

<?php while($row = mysqli_fetch_assoc($assigned)){ ?>
<tr>
    <td><?php echo $row['deal_code']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
</tr>
<?php } ?>

</table>
<a href="admin_deals.php"><button type="submit" name="backtodeal"><-- Back to deals</button></a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$('#category').change(function(){

    $.post("get_product.php",{cat_id:$(this).val()},function(data){

        $('#product').html('<option value="all">-- All Products --</option>'+data);

    });

});
</script>
<?php include 'admin_footer.php'; ?>
</body>
</html>
