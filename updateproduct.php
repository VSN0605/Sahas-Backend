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

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_FILES["image"])) {
        try {
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ruralhaa_royals";

            // Create connection
            // $conn = new mysqli($servername, $username, $password, $dbname);

            include("db-connection.php");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare SQL statement
            $stmt = $conn->prepare("UPDATE product SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");

            // Bind parameters
            $stmt->bind_param('ssisi', $_POST["name"], $_POST["description"], $_POST["price"], $filename, $_POST["id"]);

            // Upload image
            $uploadDir = 'uploads/';
            $filename = $_POST["id"] . '_' . basename($_FILES["image"]["name"]);
            $destination = $uploadDir . $filename;
    
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
                // Execute the SQL statement
                $stmt->execute();

                // Return success message
                $response["message"] = "Update successful";
                echo json_encode($response);
            } else {
                $response["error"] = "Failed to move uploaded file";
                echo json_encode($response);
            }
        } catch (Exception $e) {
            // Return error message if an exception occurred
            $response["error"] = "An error occurred while updating the data: " . $e->getMessage();
            echo json_encode($response);
        }

        // Close connection
        $conn->close();
    } else {
        // Return error message if required fields are missing
        $response["error"] = "Missing required fields";
        echo json_encode($response);
    }
} else {
    // Return error message if request method is not POST
    $response["error"] = "Invalid request method";
    echo json_encode($response);
}
?>
