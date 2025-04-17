<?php
session_start();
require 'db.php';  // Your database connection file
require 'PHPMailer/src/PHPMailer.php';  // Include PHPMailer
require 'PHPMailer/src/SMTP.php';  // Include SMTP class
require 'PHPMailer/src/Exception.php';  // Include Exception class

// Use PHPMailer's namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM destinations WHERE id = $id";
    $result = $conn->query($query);
    $destination = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_travel = $_POST['date_of_travel'];
    $destination_id = $_POST['destination_id'];

    // Insert reservation into the database
    $sql = "INSERT INTO reservations (name, email, phone, date_of_travel, destination_id) 
            VALUES ('$name', '$email', '$phone', '$date_of_travel', '$destination_id')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Your reservation has been successfully placed!";
        
        // Send email to admin
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'samyak12manandhar@gmail.com';  // Your Gmail address
            $mail->Password   = 'ntqwrbjkvsqiknxa';  // Your Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('samyak12manandhar@gmail.com', 'Reservation System');
            $mail->addAddress('samyak12manandhar@gmail.com', 'Admin');   // Admin email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Reservation Notification';
            $mail->Body    = "<h3>A new reservation has been made:</h3>"
                             . "<p><strong>Name:</strong> $name</p>"
                             . "<p><strong>Email:</strong> $email</p>"
                             . "<p><strong>Phone:</strong> $phone</p>"
                             . "<p><strong>Date of Travel:</strong> $date_of_travel</p>"
                             . "<p><strong>Destination:</strong> " . htmlspecialchars($destination['title']) . "</p>";

            // Send email
            $mail->send();
        } catch (Exception $e) {
            $message = "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Your Trip</title>
    <link rel="stylesheet" href="reserve.css">
</head>
<body>
    <h2>Reserve Your Trip to <?= $destination['title'] ?></h2>
    <?php if (isset($message)): ?>
        <p style="color: green;"><?= $message ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="destination_id" value="<?= $destination['id'] ?>">
        <label for="name">Full Name:</label>
        <input type="text" name="name" required><br>
        <label for="email">Email Address:</label>
        <input type="email" name="email" required><br>
        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone"><br>
        <label for="date_of_travel">Date of Travel:</label>
        <input type="date" name="date_of_travel" required><br>
        <button type="submit">Reserve Now</button>
    </form>
    <a href="index.php">Back to Destinations</a>
</body>
</html>
