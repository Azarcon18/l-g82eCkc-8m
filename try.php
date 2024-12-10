<?php
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

// SQL to add a new column 'login' to the 'users' table
$sql = "ALTER TABLE users ADD COLUMN login BOOLEAN DEFAULT FALSE";

if ($conn->query($sql) === TRUE) {
    echo "Column 'login' added successfully.";
} else {
    echo "Error adding column: " . $conn->error;
}

// Close connection
$conn->close();
?>