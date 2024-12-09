<?php
// Database configuration
if (!defined('DB_SERVER')) define('DB_SERVER', "localhost");
if (!defined('DB_USERNAME')) define('DB_USERNAME', "root");
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', "");
if (!defined('DB_NAME')) define('DB_NAME', "church_db");

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to add new columns
$sql = "ALTER TABLE registered_users 
        ADD COLUMN code VARCHAR(255) NULL,
        ADD COLUMN code_expired_at DATETIME NULL,
        ADD COLUMN token VARCHAR(255) NULL,
        ADD COLUMN token_expired_at DATETIME NULL";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Columns added successfully.";
} else {
    echo "Error adding columns: " . $conn->error;
}

// Close connection
$conn->close();
?>