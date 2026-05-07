<?php
include 'config/db.php';

$filename = "payment_report.csv";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

$output = fopen("php://output", "w");

/* Column Headings */
fputcsv($output, [
    'Payment ID',
    'Order ID',
    'User ID',
    'Amount',
    'Payment Method',
    'Payment Status',
    'Payment Date'
]);

/* Fetch Data */
$query = mysqli_query($conn,"
SELECT 
payment_id,
order_id,
user_id,
amount,
payment_method,
payment_status,
payment_date
FROM payments
ORDER BY payment_id DESC
");

while($row = mysqli_fetch_assoc($query)){
    fputcsv($output, $row);
}

fclose($output);
exit();
?>