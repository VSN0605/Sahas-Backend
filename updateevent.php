<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

// Handle preflight requests for CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    exit;
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if(isset($_POST['id'], $_POST['name'],$_POST['Description'],$_POST['location'], $_POST['date'],   $_FILES['image'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $Description = $_POST['Description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
        
        // Handle file upload
        $image = $_FILES['image'];
        $uploadDir = 'event/'; // Change this to your desired upload directory
        $filename = $id . '_' . basename($image['name']);
        $destination = $uploadDir . $filename;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($image['tmp_name'], $destination)) {
            // File upload successful, now you can update the record in the database
            // Establish database connection and update the record
            // $conn = new mysqli("localhost", "root", "", "ruralhaa_royals");

            include("db-connection.php");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update the record in the database
            $sql = "UPDATE event SET name='$name',Description='$Description',location='$location',date='$date',  image='$filename' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("message" => "Update successful"));
            } else {
                echo json_encode(array("error" => "Error updating database: " . $conn->error));
            }

            $conn->close();
        } else {
            echo json_encode(array("error" => "Error uploading file"));
        }
    } else {
        echo json_encode(array("error" => "Missing required fields"));
    }
} else {
    echo json_encode(array("error" => "Invalid request method"));
}
?>
