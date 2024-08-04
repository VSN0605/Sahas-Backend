<?php

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: X-Request-With');
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");

// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     header('Content-Length: 0');
//     header('Content-Type: text/plain');
//     header('Access-Control-Allow-Origin: *');
//     header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//     header('Access-Control-Allow-Headers: Content-Type, Authorization');
//     exit;
// }

// $conn = new mysqli("localhost", "root", "", "ruralhaa_royals");

// if (mysqli_connect_error()) {
//     echo mysqli_connect_error();
//     exit();
// } else {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $msg = $_POST['message'];

//     $stmt = $conn->prepare("INSERT INTO contact (id, name, email, msg, timestamp) VALUES (NULL, ?, ?, ?, NULL)");
//     $stmt->bind_param("sss", $name, $email, $msg);

//     if ($stmt->execute()) {
//         echo "Thank You For Contacting with us!";
//     } else {
//         echo "Error!";
//     }

//     $stmt->close();
//     $conn->close();
// }
?>
