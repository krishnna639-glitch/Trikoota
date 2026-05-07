<?php
session_start();
include 'config/db.php';
include 'admin_header.php';
//check if admin is logged in 
//session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

// Fetch all users with their role names
$sql = "SELECT userr.*, roles.R_name
        FROM userr 
        LEFT JOIN roles ON userr.R__id = roles.R__id
        ORDER BY userr.U_id DESC";

$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        table {
            width: 102%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px #ccc;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .btn-delete, .btn-view {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            font-size: 14px;
        }
        .btn-delete {
            background: #d9534f;
        }
        .btn-delete:hover {
            background: #c9302c;
        }
        .btn-view {
            background: #0275d8;
        }
        .btn-view:hover {
            background: #025aa5;
        }
        .back-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 12px;
            text-align: center;
            background: #444;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .back-btn:hover {
            background: #000;
        }

        
        .button{
            background:#0d6efd;
            color:white;
            padding:10px 20px;
            margin:10px 5px;
            border:none;
            border-radius:8px;
            font-size:15px;
            cursor:pointer;
            text-decoration:none;
        }

        .button:hover{
            background:#0d6efd;
        }
    </style>

</head>
<body>
<a href="admin_user_report.php" class="button">Users_report</a>
<a href="download_userr_report.php" class="button">Download Users Report</a>
<h2>All Registered Users</h2>

<table>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['U_id']; ?></td>
            <td><?php echo $row['U_name']; ?></td>
            <td><?php echo $row['U_email']; ?></td>
            <td><?php echo $row['U_phone']; ?></td>
            <td><?php echo ucfirst($row['R_name']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a class="btn-view" href="view_user.php?id=<?php echo $row['U_id']; ?>">View</a>
                 
                    <!-- don't allow deleting admin -->
                <a class="btn-delete" onclick="return confirm('Delete this user?')"
                       href="delete_user.php?id=<?php echo $row['U_id']; ?>">Delete</a>
            
            </td>
        </tr>
    <?php } ?>
</table>

<a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
<?php include 'admin_footer.php'; ?>
</body>
</html>
