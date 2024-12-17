<?php
// Include necessary database connection and other required files
require_once('../config.php');

$debug = false; // Set to true when you need to debug

// Enable error reporting for debugging
if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the appointment ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($debug) {
    echo "Debug: Received ID = " . $id . "<br>";
}

if ($id) {
    // Fetch the specific appointment data
    $query = "SELECT ar.*, st.sched_type 
              FROM appointment_schedules ar 
              LEFT JOIN schedule_type st ON ar.sched_type_id = st.id 
              WHERE ar.id = ?";
    
    if ($debug) {
        echo "Debug: Query = " . $query . "<br>";
    }

    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();

    if ($appointment) {
        // Display the appointment data using the modified template
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Death</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 12px #aaa;
            width: 80%;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        label {
            display: inline-block;
            width: 25%;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 70%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .section-header {
            margin-top: 20px;
            text-decoration: underline;
            font-weight: bold;
        }
        .btn {
            display: block;
            width: 20%;
            margin: auto;
            padding: 10px;
            text-align: center;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Certificate of Death</h2>
    <form method="POST" action="certificate_of_death.php">
        <div class="section-header">Personal Information</div>
        <label>Name:</label><input type="text" name="name" required><br>
        <label>Sex:</label>
        <select name="sex" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>
        <label>Religion:</label><input type="text" name="religion"><br>
        <label>Age:</label><input type="number" name="age" required><br>

        <div class="section-header">Death Details</div>
        <label>Place of Death:</label><input type="text" name="place_of_death" required><br>
        <label>Date of Death:</label><input type="date" name="date_of_death" required><br>
        <label>Cause of Death:</label><textarea name="cause_of_death" rows="3"></textarea><br>

        <div class="section-header">Residence</div>
        <label>Residence Address:</label><input type="text" name="residence" required><br>

        <div class="section-header">Medical Certificate</div>
        <label>Attending Physician:</label><input type="text" name="physician"><br>
        <label>Immediate Cause of Death:</label><input type="text" name="immediate_cause"><br>
        <label>Interval Between Onset and Death:</label><input type="text" name="death_interval"><br>

        <div class="section-header">Attendant</div>
        <label>Was Attended? </label>
        <select name="attended">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br>

        <div class="section-header">Other Information</div>
        <label>Burial/Cremation Permit:</label><input type="text" name="permit_no"><br>
        <label>Name of Cemetery/Crematory:</label><input type="text" name="cemetery_name"><br>
        <label>Signature of Informant:</label><input type="text" name="informant_signature"><br>

        <button type="submit" class="btn">Submit</button>
    </form>
</body>
</html>

            <script>
                // Automatically print the page when it loads
                window.onload = function() {
                    window.print();
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Appointment not found.";
    }
} else {
    echo "Invalid request. No ID provided.";
}
?>