<?php
include 'config/db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM messages WHERE message_id = $id";
    mysqli_query($conn, $query);

    header("Location: admin_messages.php");
    exit();
}
?>
