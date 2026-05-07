<?php
include 'config/db.php';

$filename = "orders_report.csv";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

$output = fopen("php://output", "w");

/* Column headings */
fputcsv($output, [
    'Order ID',
    'User ID',
    'Order Date',
    'Order Total',
    'Payment Status',
    'Order Status',
    'Deal Code',
    'Discount Amount',
    'Cancelled By'
]);

/* Fetch data */
$query = mysqli_query($conn,"
SELECT 
order_id,
user_id,
order_date,
order_total,
payment_status,
order_status,
deal_code,
discount_amount,
cancelled_by
FROM orders
ORDER BY order_id DESC
");

while($row = mysqli_fetch_assoc($query)){
    fputcsv($output, $row);
}

fclose($output);
exit();
?>