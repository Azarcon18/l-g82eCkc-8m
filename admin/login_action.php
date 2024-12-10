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
        $user = $result->fetch_assoc();

        // Verify password using MD5 hash
        if (md5($password) === $user['password']) {
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
            exit();
        } else {
            echo '<script>
                    Swal.fire({
                        title: "Login Failed",
                        text: "Invalid username or password.",
                        icon: "error"
                    }).then(() => {
                        window.location.href = "login.php";
                    });
                  </script>';
            exit();
        }
    } else {
        echo '<script>
                Swal.fire({
                    title: "Login Failed",
                    text: "Invalid username or password.",
                    icon: "error"
                }).then(() => {
                    window.location.href = "login.php";
                });
              </script>';
        exit();
    }
}
?>
