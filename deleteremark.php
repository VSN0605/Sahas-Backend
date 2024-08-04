<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header("Access-Control-Allow-Headers: X-Request-With");

// Assuming you're receiving the id via GET method
$id = $_GET['id'];

// $conn = new mysqli("localhost", "root", "", "ruralhaa_royals");
include("db-connection.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM `remark` WHERE `id`='$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['phpresult' => 'Record deleted successfully']);
} else {
    echo json_encode(['phpresult' => 'Error deleting record: ' . $conn->error]);
}

$conn->close();
?>
