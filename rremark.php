<?php  //Recreational Attendance database
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
    $data = json_decode(file_get_contents('php://input'), true);

    $attendanceOptions = isset($data['attendanceOptions']) ? $data['attendanceOptions'] : [];
    $matchesPlayed = isset($data['matchesPlayed']) ? $data['matchesPlayed'] : [];
    $remark = isset($data['remark']) ? $data['remark'] : [];
    $users = isset($data['users']) ? $data['users'] : [];

    $errors = [];

    foreach ($users as $user) {
        $id = $user['id'];
        $name = $user['name'];
        $timing = $user['timing'];

        $attendanceOption = $attendanceOptions[$id];
        $matchesPlayedValue = $matchesPlayed[$id];
        $remarkValue = $conn->real_escape_string($remark[$id]['remark']); // Corrected this line

        if (empty($attendanceOption)) {
            $errors[] = "Please fill in the attendance option for ID $id";
            break; // Skip to the next iteration
        }


        $sql = "INSERT INTO rremark (id, name, timing, attendanceOption, matchesPlayed, remark,timestamp) 
                VALUES ('$id', '$name', '$timing', '$attendanceOption', '$matchesPlayedValue', '$remarkValue',NULL);";
        
        if ($conn->query($sql) !== TRUE) {
            $errors[] = "Error inserting row with ID $id: " . $conn->error;
        }
    }


    if (empty($errors)) {
        echo "Attendance Submitted Successful!";
    } else {
        echo "Errors: " . implode(", ", $errors);
    }

    $conn->close();
}
?>

