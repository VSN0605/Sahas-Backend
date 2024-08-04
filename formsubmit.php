<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Request-With");

// $conn = new mysqli("localhost", "root", "", "ruralhaa_royals");
include("db-connection.php");

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    $vca = $_POST['vca'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $rphno = $_POST['rphno'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $Gage = $_POST['Gage'];
    
    $validtill = $_POST['validtill'];

    // $clg = $_POST['clg'];
    $role = $_POST['role'];
    $timing = $_POST['timing'];
    $joiningDate = $_POST['joiningDate'];
    $coachs = $_POST['coachs'];
    $status = $_POST['status'];
    $feestatus = $_POST['feestatus'];


    $sql = "INSERT INTO tregister (`id`, `vca`, `name`, `fname`, `address`, `mobile`, `rphno`, `email`, `dob`, `Gage`, `validtill`, `role`, `timing`, `timestamp`, `joiningdate`, `level`, `coach`, `feestatus`) 
            VALUES (NULL, '$vca', '$name', '$fname', '$address', '$mobile', '$rphno', '$email', '$dob', '$Gage', '$validtill', '$role', '$timing', NULL, '$joiningDate', '$status', '$coachs', '$feestatus')";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "Registration successful!";
    } else {    
        echo "Error: " . mysqli_error($conn);
    }
    $conn->close();
}
?>
