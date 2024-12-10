<?php
$request = $_SERVER['REQUEST_URI'];
if (substr($request, -4) == '.php') {
    $new_url = substr($request, 0, -4);
    header("Location: $new_url", true, 301);
    exit();
}
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
        // Remove start_loader() call to stop loading
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

