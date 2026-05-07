<?php
include 'config/db.php';
session_start();
?>
<?php include 'admin_header.php'; ?>
<style>
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

<div class="container">
    <a href="admin_message_report.php" class="button">Message_report</a>


    <h2 class="mt-4 mb-4">User Messages</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $query = "SELECT * FROM messages ORDER BY created_at DESC";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "
                    <tr>
                        <td>".$row['message_id']."</td>
                        <td>".$row['U_id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['subject']."</td>
                        <td>".$row['message']."</td>
                        <td>".$row['created_at']."</td>
                        <td>
                            <a href='delete_message.php?id=".$row['message_id']."' 
                               class='btn btn-danger btn-sm' 
                               onclick='return confirm(\"Delete this message?\")'>
                               Delete
                            </a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No messages found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div class="text-center mt-3">
    <a href="admin_dashboard.php" class="btn btn-dark">Back to Dashboard</a>
</div>

