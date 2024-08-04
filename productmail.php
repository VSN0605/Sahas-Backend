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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["finalprice"])) { // Check if finalprice is set in POST data
        $email = $_POST["email"];
        $name = $_POST["name"];
        $address = $_POST["address"];
        $count = $_POST["count"];
        $finalprice = $_POST["finalprice"];
        
        $to = "kmt161272@gmail.com";
        $subject = "Request of Order";

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'kmt161272@gmail.com';
            $mail->Password   = 'vghvmttspsgcvotq';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom($email);
            $mail->addAddress($to);

            // Content
            $mail->isHTML(false);
            $mail->Subject = $subject;

            // Include final price in the email body
            $mail->Body = "Name: $name\nEmail: $email\nAddress: $address\nQuantity: $count\nTotal Price: $finalprice";

            // Send email
            $mail->send();
            echo "Email sent successfully with the final price.";
        } catch (Exception $e) {
            echo "Error: Unable to send your message. Please try again later. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Final price not provided. Email not sent.";
    }
} else {
    echo "Invalid request method.";
}
?>
