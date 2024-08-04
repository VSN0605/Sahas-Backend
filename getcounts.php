<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Request-With");

    // $conn = new mysqli("localhost","root","","ruralhaa_royals");
    include("db-connection.php");

    $sql1 = "SELECT count(id) FROM tregister where id != 0";
    $sql2 = "SELECT count(id) FROM cregister where id != 0";
    $sql3 = "SELECT count(id) FROM rregister where id != 0";
    $sql4 = "SELECT count(id) FROM tregister where level='Begineer' and id != 0";
    $sql5 = "SELECT count(id) FROM tregister where level='Professional' and id != 0";

    $mysqli1 = mysqli_query($conn,$sql1);
    $mysqli2 = mysqli_query($conn,$sql2);
    $mysqli3 = mysqli_query($conn,$sql3);
    $mysqli4 = mysqli_query($conn,$sql4);
    $mysqli5 = mysqli_query($conn,$sql5);

    $json_data = array();

    $row1 = mysqli_fetch_assoc($mysqli1);
    $row2 = mysqli_fetch_assoc($mysqli2);
    $row3 = mysqli_fetch_assoc($mysqli3);
    $row4 = mysqli_fetch_assoc($mysqli4);
    $row5 = mysqli_fetch_assoc($mysqli5);
    
    $json_data[] = $row1;
    $json_data[] = $row2;
    $json_data[] = $row3;
    $json_data[] = $row4;
    $json_data[] = $row5;

    echo json_encode(['phpresult'=>$json_data]);
?>  