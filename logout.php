<?php
session_start();

// Set a session variable to indicate successful logout
$_SESSION['logout_success'] = true;

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the index page
header("Location: index.php");
exit();
?>