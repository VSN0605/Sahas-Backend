<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Request-With');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

// $conn = new mysqli("localhost", "root", "", "ruralhaa_royals");
include("db-connection.php");

// Validate and sanitize input
$name = isset($_POST['name']) ? $_POST['name'] : '';  // Add this line
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
$age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
$gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);

// Additional validation if needed

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    $stmt = $conn->prepare("INSERT INTO joinus (id, name, email, mobile, age, gender, timestamp) VALUES (NULL, ?, ?, ?, ?, ?, NULL)");
    $stmt->bind_param("sssis", $name, $email, $mobile, $age, $gender);

    if ($stmt->execute()) {
        echo "Thank You for joining!";
        
        // Contact Us mail
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $to = "ramtekeaman2002@gmail.com";
            $subject = "New Join Us Form Submission";

            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ramtekeaman2002@gmail.com';
                $mail->Password   = 'vghvmttspsgcvotq';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom($email);
                $mail->addAddress($to);

                // Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body    = "Name: $name\nEmail: $email\nMobile: $mobile\nAge: $age\nGender : $gender";

                // Send email
                $mail->send();
                echo " Thank You! Your message has been sent.";
            } catch (Exception $e) {
                echo "Error: Unable to send your message. Please try again later. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Invalid request method.";
        }
    } else {
        echo "Failed to submit. Please try again.";
        // Add additional error handling or logging here
    }

    $stmt->close();
    $conn->close();
}
?>
