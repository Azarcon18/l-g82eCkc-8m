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
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Login Successful!",
                    text: "Redirecting to dashboard...",
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
                    icon: "error",
                    title: "Login Failed!",
                    text: "Invalid username or password",
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "login.php";
                });
              </script>';
        exit();     
    } 
}
?>
