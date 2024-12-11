<?php
require_once('config.php');
require 'vendor/autoload.php'; // Include Composer's autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $pdo->prepare("SELECT user_id FROM registered_users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        // Generate a 5-digit random code
        $code = random_int(10000, 99999);

        // Update the database with the code
        $stmt = $pdo->prepare("UPDATE registered_users SET code = :code WHERE email = :email");
        $stmt->execute(['code' => $code, 'email' => $email]);

        // Send the code via email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use your domain's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'jagdonjohncarlo0714@gmail.com'; // SMTP username
            $mail->Password = 'wlyl kbyt mjam fhzv'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('jagdonjohncarlo0714@gmail.com', 'ICP MADRIDEJOS');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Verification Code';
            $mail->Body    = "Your verification code is: <strong>$code</strong>";

            $mail->send();
            echo 'A verification code has been sent to your email address.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No account found with that email address.";
    }
}
?>