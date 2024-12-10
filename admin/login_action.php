<?php
session_start();  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    $username = $_POST['username'];     
    $password = $_POST['password'];       // Get the password from POST

    // Use prepared statement for secure authentication
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?"); 
    $stmt->bind_param("s", $username);     
    $stmt->execute();     
    $result = $stmt->get_result();      

    if ($result->num_rows > 0) {
        // Fetch the hashed password from the database
        $row = $result->fetch_assoc();
        $stored_hash = $row['password']; 
        
        // Verify the password using password_verify
        if (password_verify($password, $stored_hash)) {
            $_SESSION['user'] = $username;
            session_regenerate_id(true);  // Regenerate session ID to prevent session fixation
            echo json_encode([
                "status" => "success", 
                "message" => "Login Successful! Redirecting to dashboard...",
                "redirect" => "dashboard.php"
            ]);
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "Invalid username or password"
            ]);
        }
    } else {         
        echo json_encode([
            "status" => "error", 
            "message" => "Invalid username or password"
        ]);
    }
    exit();
}
?>
