<?php
session_start();
require_once('../config.php');

// Function to update the login status of a user to TRUE (1)
function updateLoginStatus($conn, $userId) {
    $sql = "UPDATE users SET login = TRUE WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User login status updated successfully.";
    } else {
        echo "Error updating login status: " . $stmt->error;
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement for secure authentication
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, md5($password));
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user['username'];

        // Update login status for the user
        updateLoginStatus($conn, $user['id']);

        // Redirect to dashboard.php
        header("Location: dashboard.php");
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