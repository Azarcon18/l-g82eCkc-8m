<?php
// Assuming you have a database connection established
require 'initialize.php';

// Start the session
session_start();

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Invalidate all sessions for the user in the database
$stmt = $db->prepare("DELETE FROM user_sessions WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->close();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit();
?>