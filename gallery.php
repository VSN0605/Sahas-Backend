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
    
    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit();
    }
    else{

        $id = $_POST['id'];
        $type = $_POST['type'];
        $image = $_FILES['image'];
        

        $uploadDir = 'ugallery/';
        $filename = $id . '_' . $image['name'];
        $destination = $uploadDir . $filename;

        if (move_uploaded_file($image['tmp_name'], $destination)) {
           
            $sql = "INSERT INTO images (filename) VALUES ('$filename')";
            // $desc2= str_replace("'", "''", $desc);
            $sql = "INSERT INTO gallery (id, type, image) VALUES (NULL, '$type', '$filename');";
            $res = mysqli_query($conn, $sql);
            
          } else {
           echo "Error !";
        }
        
        if($res)
        {
            echo "Product  added successfully!";
        }
        else{
            echo $sql;
           // echo "error!";
        }
        $conn->close();
    }
?>