<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Request-With");

    // $conn = new mysqli("localhost","root","","ruralhaa_royals");
    include("db-connection.php");


    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit();
    }
    else{
        $name = $_POST['name'];
        $joiningdate = $_POST['joiningdate'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $exp = $_POST['exp'];
        $tournaments = $_POST['tournaments'];
        $shift = $_POST['shift'];
       
        $sql = "INSERT INTO cregister (id, name, cno, email, address, exp, tournaments, timestamp, joiningdate) VALUES (NULL, '$name' , '$mobile', '$email', '$address', '$exp', '$tournaments', NULL, '$joiningdate');";
        $res = mysqli_query($conn, $sql);

        if($res)
        {
            echo "Coach Registration Successful!";
        }
        else{
            echo "error from backend!";
        }
        $conn->close();
    }
?>