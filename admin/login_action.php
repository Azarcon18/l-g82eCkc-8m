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
        // Successful login         
        $_SESSION['user'] = $username;         
        header("Location: dashboard.php");         
        exit();     
    } else {         
        // Failed login         
        $_SESSION['error'] = "Invalid username or password";         
        header("Location: login.php");         
        exit();     
    } 
}
?>
