<?php
// Delet Contact
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

    // $conn = new mysqli("localhost","root","","ruralhaa_royals");// Get the contact ID to delete from the request
    include("db-connection.php");
    
$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $contactId = $data->id;

    // Prepare and execute the SQL statement to delete the contact
    $sql = "DELETE FROM contact WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $contactId);
    
    if ($stmt->execute()) {
        // Deletion successful
        echo json_encode(["message" => "Contact deleted successfully"]);
    } else {
        // Deletion failed
        echo json_encode(["error" => "Failed to delete contact"]);
    }

    $stmt->close();
} else {
    // ID not provided in the request
    echo json_encode(["error" => "Contact ID not provided"]);
}

$conn->close();
?>