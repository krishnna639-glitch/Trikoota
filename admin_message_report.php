<?php
include "config/db.php";
include "admin_header.php";

// Filter
$filter = $_GET['filter'] ?? 'all';

if($filter == "today"){
    $sql = "SELECT * FROM messages 
            WHERE DATE(created_at)=CURDATE()";
}
elseif($filter == "unread"){
    $sql = "SELECT * FROM messages 
            WHERE status='unread'";
}
elseif($filter == "month"){
    $sql = "SELECT * FROM messages 
            WHERE MONTH(created_at)=MONTH(CURDATE()) 
            AND YEAR(created_at)=YEAR(CURDATE())";
}
else{
    $sql = "SELECT * FROM messages";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Message Report</title>

<style>
button{
    background:#0d6efd;
    color:white;
    padding:10px 20px;
    margin:10px 5px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#084298;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th,td{
    border:1px solid #ccc;
    padding:8px;
    text-align:center;
}

th{
    background:#f2f2f2;
}
</style>

</head>

<body>

<h2>Message Reports</h2>

<form method="GET">
    <button name="filter" value="today">Today</button>
    <button name="filter" value="month">This Month</button>
    <button name="filter" value="unread">Unread</button>
    <button name="filter" value="all">All Messages</button>
</form>

<table>

<tr>
    <th>ID</th>
    <th>User ID</th>
    <th>Message</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?= $row['message_id']; ?></td>
    <td><?= $row['U_id']; ?></td>
    <td>
    <a href="admin_mark_read.php?id=<?= $row['message_id']; ?>"><?= $row['message']; ?></a>
    </td>
    <td><?= $row['status']; ?></td>
    <td><?= $row['created_at']; ?></td>
</tr>

<?php } ?>

</table>
<?php include 'admin_footer.php'; ?>
</body>
</html>
