<?php
// Contact Us mail
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

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact (id, name, email, msg, timestamp) VALUES (NULL, ?, ?, ?, NULL)");
    $stmt->bind_param("sss", $name, $email, $msg);

    if ($stmt->execute()) {
        echo "Thank You For Contacting with us!";
    } else {
        echo "Error!";
    }



if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $msg = $_POST["message"];

    $to = "ramtekeaman2002@gmail.com";
    $subject = "New Contact Form Submission";

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
        $mail->Body    = "Name: $name\nEmail: $email\nMessage:\n$msg";

        // Send email
        $mail->send();
        echo "Thank You! Your message has been sent.";
    } catch (Exception $e) {
        echo "Error: Unable to send your message. Please try again later. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";

}
    $stmt->close();
    $conn->close();
}
?>
