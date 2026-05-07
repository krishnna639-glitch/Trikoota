<?php
session_start();
include 'config/db.php';

// OPTIONAL: ADMIN AUTH CHECK
// if(!isset($_SESSION['admin_id'])){ header("Location: admin_login.php"); }

$msg = "";

// FETCH CATEGORIES
$categories = mysqli_query($conn, "SELECT categories_id, category_name FROM categories");

// FETCH PRODUCTS
$products = mysqli_query($conn, "SELECT id, name FROM products");

// INSERT DEAL
if(isset($_POST['add_deal'])){
    $deal_code = strtoupper(trim($_POST['deal_code']));
    $deal_title = $_POST['deal_title'];
    $deal_type = $_POST['deal_type'];
    $deal_value = $_POST['deal_value'];
    $min_order = $_POST['min_order'];
    $apply_on = $_POST['apply_on'];
    $category_id = $_POST['category_id'] ?: NULL;
    $product_id = $_POST['product_id'] ?: NULL;
    $valid_from = $_POST['valid_from'];
    $valid_till = $_POST['valid_till'];
    $status = $_POST['status'];

    $query = "INSERT INTO deals 
        (deal_code, deal_title, deal_type, deal_value, min_order_amount,
         apply_on, category_id, product_id, valid_from, valid_till, status)
        VALUES
        ('$deal_code','$deal_title','$deal_type','$deal_value','$min_order',
         '$apply_on','$category_id','$product_id','$valid_from','$valid_till','$status')";

    if(mysqli_query($conn, $query)){
        $msg = "✅ Deal added successfully!";
    }else{
        $msg = "❌ Error adding deal";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Deal</title>
<style>
body{
    font-family: Arial;
    background:#f3f4f6;
}
.container{
    width:550px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
}
h2{text-align:center; color:#166534;}
label{
    display:block;
    margin-top:12px;
    font-weight:bold;
}
input, select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:8px;
    border:1px solid #ccc;
}
button{
    margin-top:20px;
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#16a34a;
    color:white;
    font-size:16px;
    cursor:pointer;
}
button:hover{background:#15803d;}
.msg{
    text-align:center;
    margin-bottom:10px;
    color:#166534;
    font-weight:bold;
}
</style>

<script>
function toggleApply(){
    let applyOn = document.getElementById("apply_on").value;
    document.getElementById("cat").style.display = (applyOn=='category')?'block':'none';
    document.getElementById("prod").style.display = (applyOn=='product')?'block':'none';
}
</script>
</head>

<body>
<div class="container">
<h2>➕ Add New Deal</h2>

<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>

<form method="POST">

<label>Deal Code</label>
<input type="text" name="deal_code" required placeholder="GREEN10">

<label>Deal Title</label>
<input type="text" name="deal_title" required>

<label>Deal Type</label>
<select name="deal_type" required>
    <option value="percentage">Percentage</option>
    <option value="flat">Flat Amount</option>
</select>

<label>Deal Value</label>
<input type="number" name="deal_value" required>

<label>Minimum Order Amount</label>
<input type="number" name="min_order" value="0">

<label>Apply On</label>
<select name="apply_on" id="apply_on" onchange="toggleApply()">
    <option value="all">All Products</option>
    <option value="category">Specific Category</option>
    <option value="product">Specific Product</option>
</select>

<div id="cat" style="display:none;">
<label>Select Category</label>
<select name="categories_id">
    <option value="">-- Select Category --</option>
    <?php while($c=mysqli_fetch_assoc($categories)){ ?>
        <option value="<?= $c['categories_id']; ?>"><?= $c['category_name']; ?></option>
    <?php } ?>
</select>
</div>

<div id="prod" style="display:none;">
<label>Select Product</label>
<select name="product_id">
    <option value="">-- Select Product --</option>
    <?php while($p=mysqli_fetch_assoc($products)){ ?>
        <option value="<?= $p['id']; ?>"><?= $p['name']; ?></option>
    <?php } ?>
</select>
</div>

<label>Valid From</label>
<input type="date" name="valid_from" required>

<label>Valid Till</label>
<input type="date" name="valid_till" required>

<label>Status</label>
<select name="status">
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
</select>

<button type="submit" name="add_deal">Add Deal</button>
</form>
</div>
<?php include 'admin_footer.php'; ?>
</body>
</html>
