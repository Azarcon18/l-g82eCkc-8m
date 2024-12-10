<?php
session_start();
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Use prepared statement for secure authentication
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password using MD5 hash
        if ($user['password'] === md5($password)) {
            // Successful login, set session variables
            $_SESSION['user'] = $username;
            echo '<script>
                    Swal.fire({
                        title: "Login Successful!",
                        text: "Redirecting to the dashboard...",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "dashboard.php";
                    });
                  </script>';
        } else {
            // Incorrect password
            echo '<script>
                    Swal.fire({
                        title: "Login Failed",
                        text: "Invalid username or password.",
                        icon: "error"
                    }).then(() => {
                        window.location.href = "login.php";
                    });
                  </script>';
        }
    } else {
        // Username not found
        echo '<script>
                Swal.fire({
                    title: "Login Failed",
                    text: "Invalid username or password.",
                    icon: "error"
                }).then(() => {
                    window.location.href = "login.php";
                });
              </script>';
    }
}
?>
