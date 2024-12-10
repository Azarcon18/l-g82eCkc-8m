<?php
session_start();
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement for secure authentication
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, md5($password));
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        $user = $result->fetch_assoc();
        $userId = $user['id'];
        $_SESSION['user_id'] = $userId;

        // Store session ID in the database
        $sessionId = session_id();
        $stmt = $conn->prepare("INSERT INTO user_sessions (user_id, session_id) VALUES (?, ?)");
        $stmt->bind_param("is", $userId, $sessionId);
        $stmt->execute();

        echo '<script>
            window.location.href = "dashboard.php";
        </script>';
        exit();
    } else {
        // Failed login
        echo '<script>
            alert("Invalid username or password");
            window.location.href = "login.php";
        </script>';
        exit();
    }
}
?>