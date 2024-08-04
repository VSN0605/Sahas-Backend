<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: X-Request-With");

include("db-connection.php");

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    // Debug statement to print the contents of the $_POST array
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    $id = $_POST['id'] ?? '';
    $vca = $_POST['vca'] ?? '';
    $name = $_POST['name'] ?? '';
    $fname = $_POST['fname'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $rphno = $_POST['rphno'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $Gage = $_POST['Gage'] ?? '';
    $validtill = $_POST['validtill'] ?? '';
    $joiningDate = $_POST['joiningdate'] ?? '';
    $feestatus = $_POST['feestatus'] ?? '';
    $role = $_POST['role'] ?? '';
    $timing = $_POST['timing'] ?? '';

    $sql = "UPDATE rregister SET 
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
        echo "Error!";
    }
    $conn->close();
}

?>