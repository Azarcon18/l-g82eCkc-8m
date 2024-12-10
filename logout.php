<?php
function logoutUser() {
    // Start the session if it's not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Unset all session variables
    $_SESSION = [];

    // Get session parameters
    $params = session_get_cookie_params();

    // Delete the session cookie
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );

    // Destroy the session
    session_destroy();

    // Redirect to the login page or home page
    header("Location: index.php");
    exit();
}

// Call the logout function
logoutUser();
?>