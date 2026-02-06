<?php

require_once('DBconnect.php');
require_once('session.php');


$old = mysqli_fetch_assoc(mysqli_query($conn, "select * from services where business_no = '" . $_SESSION["business_no"] . "'"));


$business_no = ($_POST['business_no'] != "") ? $_POST['business_no'] : $_SESSION["business_no"];
$service_name = ($_POST['name'] != "") ? $_POST['service_name'] : $old["business_no"];
$packages = ($_POST['packages'] != "") ? $_POST['packages'] : $old["packages"];
$datetime = isset($_POST['datetime']) ? $_POST['datetime'] : $old['datetime'];
$price = ($_POST['price'] != "") ? $_POST['price'] : $old["service_price"];
$contact_info = ($_POST['contact_no'] != "") ? $_POST['contact_no'] : $old["contact_info"];



$sql = "update services set business_no ='" . $business_no . "',datetime='" . $datetime . "',packages='" . $packages . "',service_price='" . $price . "',service_name='" . $service_name . "',contact_info='" . $contact_info . "' where business_no = '" . $_SESSION['business_no'] . "'";

mysqli_query($conn, $sql);

$oldno = $_SESSION['business_no'];
$newno = $business_no;


$sql = "UPDATE payment SET business_phn_no = '$newno' WHERE business_phn_no = '$oldno'";

if (!mysqli_query($conn, $sql)) {
    echo "Error updating $table: " . mysqli_error($conn);
    exit;
}
header("Location: Service-page.php");
exit;
