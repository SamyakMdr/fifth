<?php
require 'db.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Use PHPMailer's namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the form inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert form data into the database
    $sql = "INSERT INTO messages (name, email, phone, subject, message) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message')";

if ($conn->query($sql)) {
    echo "<script>alert('Message sent successfully!');</script>";

        
        // Send email to the admin
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Use Gmail's SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'samyak12manandhar@gmail.com';  // Your Gmail address
            $mail->Password   = 'ntqwrbjkvsqiknxa';  // Your Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('samyak12manandhar@gmail.com', 'Contact Form');
            $mail->addAddress('samyak12manandhar@gmail.com', 'Admin');   // Admin email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Message';
            $mail->Body    = "<h3>You have a new message from the contact form:</h3>"
                             . "<p><strong>Name:</strong> $name</p>"
                             . "<p><strong>Email:</strong> $email</p>"
                             . "<p><strong>Phone:</strong> $phone</p>"
                             . "<p><strong>Subject:</strong> $subject</p>"
                             . "<p><strong>Message:</strong> $message</p>";

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="back-button" onclick="window.history.back();" style="
    background: linear-gradient(90deg, #1e3c72, #2a5298);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    font-weight: 500;"
    >Go Back</button>
</body>
</html>

