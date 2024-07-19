<?php
// Logout logic, e.g., clearing session
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>
