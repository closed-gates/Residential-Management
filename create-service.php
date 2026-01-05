<?php
require_once('auth.php');
require_once('DBconnect.php');

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: create-service.php");
    exit;
}

// Sanitize inputs
$business_no = mysqli_real_escape_string($conn, $_POST['business_no']);
$service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
$packages = mysqli_real_escape_string($conn, $_POST['packages']);
$service_datetime = mysqli_real_escape_string($conn, $_POST['datetime']);
$price = mysqli_real_escape_string($conn, $_POST['service_price']);
$contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);

if (
    empty($business_no) ||
    empty($service_name) ||
    empty($packages) ||
    empty($service_datetime) ||
    empty($price) ||
    empty($contact_info)
) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: create-service.php");
    exit;
}

// INSERT query
$sql = "INSERT INTO services 
        (business_no, service_datetime, packages, price, service_name, contact_info)
        VALUES 
        ('$business_no', '$service_datetime', '$packages', '$price', '$service_name', '$contact_info')";

if (mysqli_query($conn, $sql)) {
    $_SESSION['success'] = "Service created successfully.";
} else {
    $_SESSION['error'] = "Database error: " . mysqli_error($conn);
}

header("Location: Service-page.php");
exit;
