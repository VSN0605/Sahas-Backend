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
   
        $id = $_POST['id'];
        $fupdate = $_POST['fupdate'];
        $dupdate = $_POST['dupdate'];
       
        //$sql = "INSERT INTO appuser (id, name, mobile, email) VALUES ('$id', '$name', '$mobile', '$email');";
        $sql = "UPDATE `tregister` SET `$fupdate` = '$dupdate' WHERE `tregister`.`id` = $id;";
        $res = mysqli_query($conn, $sql);

        if($res)
        {
            echo "Sucess!";
        }
        else{
            echo "error!";
        }
        $conn->close();
    }
?>