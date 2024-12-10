<?php
session_start();
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement for secure authentication
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, fetch user data
        $user = $result->fetch_assoc();

        // Verify password using MD5 hash
        if (md5($password) === $user['password']) {
            // Successful login, set session variables
            $_SESSION['user'] = $username;  // Store user info in session
            header('Location: dashboard.php');  // Redirect to dashboard
            exit();
        } else {
            // Failed login - incorrect password
            $_SESSION['error'] = "Invalid username or password.";
            header('Location: login.php');  // Redirect to login page
            exit();
        }
    } else {
        // Failed login - username not found
        $_SESSION['error'] = "Invalid username or password.";
        header('Location: login.php');  // Redirect to login page
        exit();
    }
}
?>
