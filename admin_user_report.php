<?php
include "config/db.php";
include "admin_header.php";

// Filter
$filter = $_GET['filter'] ?? 'all';

if($filter == "today"){
    $sql = "SELECT * FROM userr 
            WHERE DATE(created_at)=CURDATE()";
}
elseif($filter == "month"){
    $sql = "SELECT * FROM userr 
            WHERE MONTH(created_at)=MONTH(CURDATE()) 
            AND YEAR(created_at)=YEAR(CURDATE())";
}
else{
    $sql = "SELECT * FROM userr";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>User Registration Report</title>

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

<h2>User Registration Reports</h2>

<form method="GET">
    <button name="filter" value="today">Today Users</button>
    <button name="filter" value="month">This Month Users</button>
    <button name="filter" value="all">All Users</button>
</form>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Registered Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?= $row['U_id']; ?></td>
    <td><?= $row['U_name']; ?></td>
    <td><?= $row['U_email']; ?></td>
    <td><?= $row['created_at']; ?></td>
</tr>

<?php } ?>

</table>
<?php include 'admin_footer.php'; ?>
</body>
</html>
