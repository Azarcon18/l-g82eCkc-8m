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
        
        // Verify password using password_verify (assumes password is hashed using password_hash)
        if (password_verify($password, $user['password'])) {
            // Successful login, set session variables
            $_SESSION['user'] = $username;  // You can store the user ID or any other data in the session
            header('Location: dashboard.php');  // Redirect to dashboard
            exit();
        } else {
            // Failed login - incorrect password
            echo '<script>
                    alert("Invalid username or password");
                    window.location.href = "login.php";
                  </script>';
            exit();
        }
    } else {
        // Failed login - username not found
        echo '<script>
                alert("Invalid username or password");
                window.location.href = "login.php";
              </script>';
        exit();
    }
}
?>
