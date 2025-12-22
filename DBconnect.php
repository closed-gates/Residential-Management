<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_management";


$conn = new mysqli($servername,$username,$password);

if ($conn->connect_error){
    die("connection_failed" . $conn->connection_error);

    }
else{
    mysqli_select_db($conn,$dbname);
    echo "Connection Successful";
    }


?>