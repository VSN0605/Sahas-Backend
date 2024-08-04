<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: X-Request-With");

include("db-connection.php");

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    $id = $_POST['id']; // Assuming the player ID is also sent
    $vca = $_POST['vca'];
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $rphno = $_POST['rphno'];
    $dob = $_POST['dob'];
    $Gage = $_POST['Gage'];
    $validtill = $_POST['validtill'];
    $joiningDate = $_POST['joiningdate'];
    $feestatus = $_POST['feestatus'];
    // $sport = $_POST['sport'];
    $role = $_POST['role'];
    $timing = $_POST['timing'];

    $sql = "UPDATE tregister SET 
                `vca` = '$vca', 
                `name` = '$name', 
                `fname` = '$fname', 
                `address` = '$address', 
                `mobile` = '$mobile', 
                `rphno` = '$rphno', 
                `dob` = '$dob', 
                `Gage` = '$Gage', 
                `validtill` = '$validtill', 
                `role` = '$role', 
                `timing` = '$timing', 
                `joiningdate` = '$joiningDate', 
                `feestatus` = '$feestatus' 
            WHERE `id` = '$id'";
    
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "Update Successful!";
    } else {
        echo "error!";
    }
    $conn->close();
}
?>
