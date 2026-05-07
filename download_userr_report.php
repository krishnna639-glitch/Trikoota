<?php
include 'config/db.php';

$filename = "users_report.csv";

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

$output = fopen("php://output", "w");

/* Column Headings */
fputcsv($output, [
    'User ID',
    'Name',
    'Email',
    'Phone',
    'Address',
    'Registered Date'
]);

/* Fetch Data */
$query = mysqli_query($conn,"
SELECT 
U_id,
U_name,
U_email,
U_phone,
address,
created_at
FROM userr
ORDER BY U_id DESC
");

while($row = mysqli_fetch_assoc($query)){
    fputcsv($output, $row);
}

fclose($output);
exit();
?>