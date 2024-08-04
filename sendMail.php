<?php

$to = "test@localhost";
$subject = "Test Email from XAMPP/Mercury";
$message = "This is a test email sent from Mercury Mail through XAMPP.";
$headers = "From: test@localhost";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed.";
}

?>
