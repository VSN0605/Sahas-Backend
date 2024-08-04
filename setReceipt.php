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
        $rid = $_POST['rid'];
        $id = $_POST['id'];
        $name = $_POST['name'];
        $time = $_POST['time'];
        $joiningDate = $_POST['joiningDate'];
        $amount = $_POST['amount'];
        $for = $_POST['for'];
        $validTill  = $_POST['validTill'];
        $ProspectusFee = $_POST['ProspectusFee'];
        $RegistrationFee = $_POST['RegistrationFee'];
        $CoachingFee = $_POST['CoachingFee'];
        $RecreatioalFee = $_POST['RecreatioalFee'];
        $MaintanenceFee = $_POST['MaintanenceFee'];
        $ActiviyFee = $_POST['ActiviyFee'];
        $UniformFee = $_POST['UniformFee'];
        $SportFee = $_POST['SportFee'];
        $OtherFee = $_POST['OtherFee'];

        //$sql = "INSERT INTO appuser (id, name, mobile, email) VALUES ('$id', '$name', '$mobile', '$email');";
        $sql = "INSERT INTO `receipt` (`id`, `uid`, `name`, `time`, `joining_date`, `validTill`, `ProspectusFee`, `RegistrationFee`, `CoachingFee`, `RecreatioalFee`, `MaintanenceFee`, `ActiviyFee`, `UniformFee`, `SportFee`, `OtherFee`, `amount`, `for`, `timestamp` ) VALUES ('$rid', '$id', '$name', '$time', '$joiningDate', '$validTill', '$ProspectusFee', '$RegistrationFee', '$CoachingFee', '$RecreatioalFee', '$MaintanenceFee', '$ActiviyFee', '$UniformFee', '$SportFee', '$OtherFee', '$amount', '$for', NULL);";
        $res = mysqli_query($conn, $sql);
            
       
        
        if($res)
        {
            if (strpos($for, 'coaching') !== false) { 
                $sql1 = "UPDATE `tregister` SET `validtill` = '$validTill' WHERE `id` = $id;";
                $res1 = mysqli_query($conn, $sql1);
            } else {
                $sql2 = "UPDATE `rregister` SET `validtill` = '$validTill' WHERE `id` = $id;";
                $res1 = mysqli_query($conn, $sql2);
            }    
            echo 'Receipt Generated!';
        }
        else{
            echo $sql       ;
        }
        $conn->close();
    }
?>