<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoloader

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $tourPackage = $_POST['tourPackage']; // Get tour package name

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'server251.web-hosting.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'info@negomboboattourexperience.com'; // SMTP username
        $mail->Password = '#surajmalaka#206'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port

        // Recipients
        $mail->setFrom('info@negomboboattourexperience.com', 'Negombo Boat Tour Experience');
        $mail->addAddress('negamboboattourexperiance@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'New Booking Form Submission: ' . $subject;

        // Email template with tour package
        $emailTemplate = "
            <div style='background-color: #e3f2fd; padding: 20px; border-radius: 10px;'>
                <h2 style='color: #1976d2;'>New Booking Form Submission</h2>
                <p><strong>Tour Package:</strong> $tourPackage</p>
                <p><strong>First Name:</strong> $firstName</p>
                <p><strong>Last Name:</strong> $lastName</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Message:</strong> $message</p>
            </div>
            <footer style='margin-top: 20px; text-align: center; color: #666;'>
                <p>Email service provided by <strong>idearigs</strong> © 2023</p>
            </footer>
        ";

        $mail->Body = $emailTemplate;

        // Send email
        $mail->send();
        echo 'Message has been sent!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>