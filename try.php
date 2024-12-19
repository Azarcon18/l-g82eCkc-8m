<?php
// Database connection settings
$host = "127.0.0.1";
$username = "u510162695_church_db";
$password = "1Church_db";
$dbname = "u510162695_church_db";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL statement to select all data from the table
$sql = "SELECT * FROM `appointment_schedules`";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Start the HTML table
    echo "<table border='1'>";
    echo "<tr>";

    // Fetch the column names
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";

    // Fetch and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    // End the HTML table
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>