<?php 
$conn = mysqli_connect("localhost","root","","trikoota_new");
if(!$conn)
{
    die("Database Connection Failed!".mysqli_connect_error());
}
?>