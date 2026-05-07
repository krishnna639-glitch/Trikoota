<?php
include 'config/db.php';

$filename = "products_report.csv";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

$output = fopen("php://output", "w");

/* Column Headings */
fputcsv($output, [
    'Product ID',
    'Categories ID',
    'Product Name',
    'Price',
    'Stock Quantity',
    'Created Date'
]);

/* Fetch Data */
$query = mysqli_query($conn,"
SELECT 
id,
categories_id,
name,
price,
stock_quantity,
created_at
FROM products
ORDER BY id DESC
");

while($row = mysqli_fetch_assoc($query)){
    fputcsv($output, $row);
}

fclose($output);
exit();
?>