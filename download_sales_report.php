<?php
include 'config/db.php';

$filename = "sales_report.csv";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

$output = fopen("php://output", "w");

/* Column Headings */
fputcsv($output, [
    'Order ID',
    'User ID',
    'Order Date',
    'Order Total',
    'Discount Amount',
    'Final Amount',
    'Payment Status',
    'Order Status'
]);

/* Fetch ONLY Paid Orders */
$query = mysqli_query($conn,"
SELECT 
order_id,
user_id,
order_date,
order_total,
discount_amount,
(order_total - discount_amount) AS final_amount,
payment_status,
order_status
FROM orders
WHERE payment_status = 'Paid'
ORDER BY order_id DESC
");

while($row = mysqli_fetch_assoc($query)){
    fputcsv($output, $row);
}

fclose($output);
exit();
?>