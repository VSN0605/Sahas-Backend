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

// $conn = new mysqli("localhost", "root", "", "ruralhaa_royals");

include("db-connection.php");

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $Description = $_POST['Description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $image = $_FILES['image'];

    $uploadDir = 'event/';
    $filename = $id . '_' . $image['name'];
    $destination = $uploadDir . $filename;

    if (move_uploaded_file($image['tmp_name'], $destination)) {
        $sql = "INSERT INTO images (filename) VALUES ('$filename')";
        $sql = "INSERT INTO event (id, name, Description, date, location, image) VALUES (NULL, '$name', '$Description', '$date', '$location', '$filename')";
        $res = mysqli_query($conn, $sql);
    } else {
        echo "Error uploading file!";
    }

    if ($res) {
        echo "Event added successfully!";
    } else {
        echo "Error adding event!";
    }
    $conn->close();
}
?>
