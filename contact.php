<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if POST keys exist before using them
    $name = isset($_POST['user-name']) ? htmlspecialchars($_POST['user-name']) : '';
    $email = isset($_POST['user-email']) ? htmlspecialchars($_POST['user-email']) : '';
    $message = isset($_POST['user-message']) ? htmlspecialchars($_POST['user-message']) : '';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'server251.web-hosting.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'info@negomboboattourexperience.com'; // SMTP username
        $mail->Password = '#surajmalaka#206'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('info@negomboboattourexperience.com', 'NTE - Contact Submission');
        $mail->addAddress('negamboboattourexperiance@gmail.com', 'Recipient Name'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .header { background-color: #ADD8E6; padding: 10px; text-align: center; }
                    .footer { background-color: #f1f1f1; padding: 10px; text-align: center; font-size: 12px; }
                </style>
            </head>
            <body>
                <div class='header'>
                    <h2>Contact Form Submission</h2>
                </div>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Message:</strong> $message</p>
                <div class='footer'>
                    <p>Mail service provided by <strong>idearigs</strong> &copy; " . date('Y') . "</p>
                </div>
            </body>
            </html>
        ";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Message has been sent']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
}
?>