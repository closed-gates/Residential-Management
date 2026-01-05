<?php

require_once('DBconnect.php');



// Sanitize inputs
$business_no = mysqli_real_escape_string($conn, $_POST['business_no']);
$service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
$packages = mysqli_real_escape_string($conn, $_POST['packages']);
$datetime = mysqli_real_escape_string($conn, $_POST['datetime']);
$price = mysqli_real_escape_string($conn, $_POST['service_price']);
$contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);

// INSERT query
$sql = "INSERT INTO services 
        (business_no, datetime, packages, service_price, service_name, contact_info)
        VALUES 
        ('$business_no', '$datetime', '$packages', '$price', '$service_name', '$contact_info')";

mysqli_query($conn, $sql);

header("Location: Service-page.php");
exit;
