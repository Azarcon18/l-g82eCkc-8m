<?php
require_once('../../config.php');

$response = ['status' => 'failed', 'msg' => 'An error occurred'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone_no = isset($_POST['phone_no']) ? trim($_POST['phone_no']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : 'inactive';

    // Validate required fields
    if (empty($name) || empty($user_name) || empty($email)) {
        $response['msg'] = 'Name, Username, and Email are required.';
        echo json_encode($response);
        exit;
    }

    // Check if updating or creating a new user
    if ($user_id > 0) {
        // Update existing user
        $stmt = $conn->prepare("UPDATE `registered_users` SET `name`=?, `user_name`=?, `email`=?, `phone_no`=?, `address`=?, `status`=?, `date_updated`=CURRENT_TIMESTAMP WHERE `user_id`=?");
        $stmt->bind_param("ssssssi", $name, $user_name, $email, $phone_no, $address, $status, $user_id);
    } else {
        // Create new user
        $password = password_hash('default_password', PASSWORD_BCRYPT); // Set a default password or handle password input
        $stmt = $conn->prepare("INSERT INTO `registered_users` (`name`, `user_name`, `email`, `password`, `phone_no`, `address`, `status`, `date_created`) VALUES (?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $stmt->bind_param("sssssss", $name, $user_name, $email, $password, $phone_no, $address, $status);
    }

    // Execute the query
    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['msg'] = 'User information saved successfully.';
    } else {
        $response['msg'] = 'Failed to save user information.';
    }

    $stmt->close();
}

echo json_encode($response);
$conn->close();
?>