<?php
session_start();

// Destroy all sessions
session_unset();
session_destroy();

// Redirect to login page
echo "<script>alert('You have been logged out successfully'); 
window.location='trikoota.php';</script>";
exit;
?>
