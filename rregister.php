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

    // $name = $_POST['name'];
    // $fname = $_POST['fname'];
    // $mobile = $_POST['mobile'];
    // $address = $_POST['address'];
    // $rphno = $_POST['rphno'];
    // $dob = $_POST['dob'];
    // $clg = $_POST['clg'];
    // $sport = $_POST['sport'];
    // $timing = $_POST['timing'];
    // $joiningDate = $_POST['joiningDate'];

    // $sql = "INSERT INTO rregister (id, name, fname, address, mobile, rphno, dob, clg, sport, timing, timestamp, joiningdate) VALUES (NULL , '$name', '$fname', '$address', '$mobile', '$rphno', '$dob', '$clg', '$sport', '$timing', NULL, '$joiningDate');";
    // $res = mysqli_query($conn, $sql);
    $vca = $_POST['vca'];
        $timing = $_POST['timing'];

    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $rphno = $_POST['rphno'];
    $dob = $_POST['dob'];
    $Gage = $_POST['Gage'];
    // $clg = $_POST['clg'];
    $validtill = $_POST['validtill'];
    $joiningDate = $_POST['joiningDate'];
    $feestatus = $_POST['feestatus'];

    $sport = $_POST['sport'];
    $role = $_POST['role'];

    // $coachs = $_POST['coachs'];
    // $status = $_POST['status'];


    //$sql = "INSERT INTO appuser (id, name, mobile, email) VALUES ('$id', '$name', '$mobile', '$email');";
    // $sql = "INSERT INTO rregister (id,vca,name, fname, address, mobile, rphno, dob,Gage,clg, sport, timing, timestamp, joiningdate) VALUES (NULL ,'$vca', '$name', '$fname', '$address', '$mobile', '$rphno','$dob', '$Gage', '$clg', '$sport', '$timing', NULL, '$joiningDate');";
    $sql = "INSERT INTO rregister (id, vca, name, fname, address, mobile, rphno, dob, Gage, validtill, sport,role, timing, timestamp, joiningdate, feestatus) 
        VALUES (NULL, '$vca', '$name', '$fname', '$address', '$mobile', '$rphno', '$dob', '$Gage', '$validtill', '$sport','$role', '$timing', NULL, '$joiningDate', '$feestatus')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "Registration Successful!";
    } else {
        echo "error!";
    }
    $conn->close();
}
?>