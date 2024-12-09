<?php
// Database credentials
$host = "127.0.0.1";
$username = "u510162695_church_db";
$password = "1Church_db";
$dbname = "u510162695_church_db";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to add new columns to the registered_users table
$sql = "ALTER TABLE registered_users 
        ADD COLUMN code VARCHAR(255) NULL,
        ADD COLUMN code_expired_at DATETIME NULL,
        ADD COLUMN token VARCHAR(255) NULL,
        ADD COLUMN token_expired_at DATETIME NULL";

if ($conn->query($sql) === TRUE) {
    echo "Columns added successfully to registered_users table.<br>";
} else {
    echo "Error adding columns: " . $conn->error . "<br>";
}

// Close connection
$conn->close();
?>