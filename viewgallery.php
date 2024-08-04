<?php

// neew  code 

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
        

        $sql = "select * from gallery";
        $mysqli = mysqli_query($conn,$sql);
        $json_data = array();
    
        while($row = mysqli_fetch_assoc($mysqli))
        {
            $json_data[] = $row;
        }
        echo json_encode(['phpresult'=>$json_data]);
    }
?>  