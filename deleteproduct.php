<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204); // No Content
    exit;
}

// Check if Content-Type header is application/json
$content_type = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if ($content_type !== 'application/json') {
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Content-Type must be application/json"));
    exit;
}

// $conn = new mysqli("localhost", "root", "", "ruralhaa_royals");
include("db-connection.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID parameter from the request
$data = json_decode(file_get_contents("php://input"), true);
$id = isset($data['id']) ? intval($data['id']) : null;

// Check if ID exists
if ($id === null) {
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "ID parameter is missing or invalid"));
    exit;
}

// Prepare and bind the SQL statement
$sql = "DELETE FROM product WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Execute the statement
if ($stmt->execute()) {
    http_response_code(200); // OK
    echo json_encode(array("message" => "Record deleted successfully"));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array("message" => "Error deleting record: " . $conn->error));
}

$stmt->close();
$conn->close();
?>
