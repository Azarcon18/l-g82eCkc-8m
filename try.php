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

// SQL statement to alter the table
$sql = "
ALTER TABLE `appointment_schedules`
ADD COLUMN `registry_no` varchar(50) DEFAULT NULL,
ADD COLUMN `province` varchar(100) DEFAULT NULL,
ADD COLUMN `city_municipality` varchar(100) DEFAULT NULL,
ADD COLUMN `age_at_death` varchar(50) DEFAULT NULL,
ADD COLUMN `place_of_death` text DEFAULT NULL,
ADD COLUMN `religion` varchar(100) DEFAULT NULL,
ADD COLUMN `occupation` varchar(100) DEFAULT NULL,
ADD COLUMN `immediate_cause` text DEFAULT NULL,
ADD COLUMN `antecedent_cause` text DEFAULT NULL,
ADD COLUMN `underlying_cause` text DEFAULT NULL,
ADD COLUMN `other_conditions` text DEFAULT NULL,
ADD COLUMN `maternal_condition` varchar(100) DEFAULT NULL,
ADD COLUMN `manner_of_death` varchar(100) DEFAULT NULL,
ADD COLUMN `place_of_occurrence` varchar(100) DEFAULT NULL,
ADD COLUMN `autopsy` varchar(3) DEFAULT NULL,
ADD COLUMN `attendant` varchar(100) DEFAULT NULL,
ADD COLUMN `corpse_disposal` varchar(100) DEFAULT NULL,
ADD COLUMN `cemetery_crematory` text DEFAULT NULL;
";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Table `appointment_schedules` altered successfully.";
} else {
    echo "Error altering table: " . $conn->error;
}

// Close the connection
$conn->close();
?>