<?php
require_once('../config.php'); // Ensure this file contains your database connection setup

try {
    // SQL query to create the user_sessions table
    $sql = "
    CREATE TABLE IF NOT EXISTS user_sessions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        session_id VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Table user_sessions created successfully.";
    } else {
        echo "Error creating table: " . $conn->error;
    }
} catch (Exception $e) {
    echo "Exception occurred: " . $e->getMessage();
}

// Close the database connection
$conn->close();
?>