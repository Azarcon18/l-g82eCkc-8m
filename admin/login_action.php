<?php
session_start();
require_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Debug: Ensure inputs are captured
    if (empty($username) || empty($password)) {
        die("Username or Password cannot be empty.");
    }

    // Secure query execution
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if (!$stmt) {
        die("Query Preparation Failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check password with MD5
        if ($user['password'] === md5($password)) {
            $_SESSION['user'] = $username;  // Successful login
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    Swal.fire({
                        title: "Login Successful!",
                        text: "Redirecting to the dashboard...",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.replace("dashboard.php");
                    });
                  </script>';
        } else {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    Swal.fire({
                        title: "Login Failed",
                        text: "Invalid username or password.",
                        icon: "error"
                    }).then(() => {
                        window.location.replace("login.php");
                    });
                  </script>';
        }
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                Swal.fire({
                    title: "Login Failed",
                    text: "Invalid username or password.",
                    icon: "error"
                }).then(() => {
                    window.location.replace("login.php");
                });
              </script>';
    }
}
?>
