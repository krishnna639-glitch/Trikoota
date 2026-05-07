<?php
include 'config/db.php';

$cat=$_POST['cat_id'];

$q=mysqli_query($conn,"SELECT * FROM products WHERE categories_id=$cat");

while($p=mysqli_fetch_assoc($q)){
 echo "<option value='{$p['id']}'>{$p['name']}</option>";
}
