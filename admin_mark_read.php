<?php
include "config/db.php";

$id = $_GET['id'];

mysqli_query($conn,"UPDATE messages SET status='read' WHERE message_id='$id'");

header("Location: admin_message_report.php");
?>
