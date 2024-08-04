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
    $data = json_decode(file_get_contents('php://input'), true);

    $attendanceOptions = isset($data['attendanceOptions']) ? $data['attendanceOptions'] : [];
    $matchesPlayed = isset($data['matchesPlayed']) ? $data['matchesPlayed'] : [];
    $Wicket = isset($data['Wicket']) ? $data['Wicket'] : [];
    $runscore = isset($data['runscore']) ? $data['runscore'] : [];

    $remark = isset($data['remark']) ? $data['remark'] : [];
    $users = isset($data['users']) ? $data['users'] : [];

    $errors = [];

    foreach ($users as $user) {
        $id = (int) $user['id']; // Ensure id is cast to int
        $name = $conn->real_escape_string($user['name']);
        $type2 = $conn->real_escape_string($user['type2']);
        $timing = $conn->real_escape_string($user['timing']);
        // $coach = $conn->real_escape_string($user['coach']);

        $attendanceOption = $conn->real_escape_string($attendanceOptions[$id]);
        $matchesPlayedValue = (int) $matchesPlayed[$id]; // Ensure matchesPlayed is cast to int
        $remarkValue = $conn->real_escape_string($remark[$id]['remark']);

        // Add Wicket and runscore to the SQL query
        $WicketValue = $conn->real_escape_string($Wicket[$id]);
        $runscoreValue = (int) $runscore[$id];

        $sql = "INSERT INTO remark (id, name, type2, timing, attendanceOption, Wicket, runscore, matchesPlayed, remark, timestamp) 
                VALUES ('$id', '$name', '$type2', '$timing', '$attendanceOption', '$WicketValue', '$runscoreValue', '$matchesPlayedValue', '$remarkValue', NULL)";

        if ($conn->query($sql) !== TRUE) {
            $errors[] = "Error inserting row with ID $id: " . $conn->error;
        }
    }

    if (empty($errors)) {
        echo "Attendance Submitted Successfully!";
    } else {
        echo "Errors: " . implode(", ", $errors);
    }

    $conn->close();
}
?>
