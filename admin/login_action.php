<?php 
session_start(); 
require_once('../config.php');  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    $username = $_POST['username'];     
    $password = $_POST['password'];      

    // Use prepared statement for secure authentication     
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");     
    $stmt->bind_param("ss", $username, md5($password));     
    $stmt->execute();     
    $result = $stmt->get_result();      

    if ($result->num_rows > 0) {         
        $_SESSION['user'] = $username;         
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
    exit();
}
?>
