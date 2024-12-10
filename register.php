<?php
require_once('../config.php');

// Retrieve and sanitize form data
$name = htmlspecialchars(trim($_POST['name']));
$user_name = htmlspecialchars(trim($_POST['user_name']));
$email = htmlspecialchars(trim($_POST['email']));
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone_no = htmlspecialchars(trim($_POST['phone_no']));
$address = htmlspecialchars(trim($_POST['address']));
$status = htmlspecialchars(trim($_POST['status']));
$verification_code = md5(uniqid(rand(), true)); // Unique code for verification

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO registered_users (name, user_name, email, password, phone_no, address, status, verification_code, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)");
$stmt->bind_param("ssssssss", $name, $user_name, $email, $password, $phone_no, $address, $status, $verification_code);

// Execute the statement
if ($stmt->execute()) {
    // Send verification email
    $subject = "Email Verification";
    $message = "Hello $name, \n\nPlease verify your email by clicking the link below:\n";
    $message .= "https://icpmadridejos.com/verify.php?code=$verification_code";
    $headers = "From: John Carlo Jagdon";

    if (mail($email, $subject, $message, $headers)) {
        $_SESSION['success'] = "Account created successfully. Please check your email for verification.";
    } else {
        $_SESSION['error'] = "Account created, but failed to send verification email.";
    }
} else {
    $_SESSION['error'] = "Failed to create account.";
}

// Close the statement
$stmt->close();

// Redirect to index
header('Location: ../index.php');