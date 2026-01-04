<?php
require_once('DBconnect.php');
require_once('session.php');
$n = $_POST['name'];
$d = $_POST['deal'];
$p = $_POST['p'];
$i = $_POST['id'];
$sql = "insert into online_groceries values ('$i','$d','01xxxxxxxxxx','$n','$p')";
mysqli_query($conn,$sql);
header("Location: grocery-page.php");
?>