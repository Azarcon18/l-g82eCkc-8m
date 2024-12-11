<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $verification_code = $_POST['verification_code'];
    $token = $_POST['token'];

    // Debugging: Output received values
    error_log("Email: $email, Code: $verification_code, Token: $token");

    // Check if the code and token exist in the database for the given email
    $stmt = $pdo->prepare("SELECT user_id FROM registered_users WHERE email = :email AND code = :code AND token = :token");
    $stmt->execute(['email' => $email, 'code' => $verification_code, 'token' => $token]);
    $user = $stmt->fetch();

    if ($user) {
        // Code and token are correct, proceed with the next steps (e.g., password reset)
        echo json_encode(['success' => true, 'message' => 'Verification successful.']);
    } else {
        // Debugging: Log error details
        error_log("Verification failed for Email: $email, Code: $verification_code, Token: $token");
        echo json_encode(['success' => false, 'message' => 'Invalid verification code or token.']);
    }
}
?>