<?php

require_once('DBconnect.php');
require_once('session.php');
$t = $_POST['t_id'];
$old = mysqli_fetch_assoc(mysqli_query($conn, "select * from complaint_suggestion where token_id = $t"));
$s = ($_POST['sugg'] != "") ? $_POST['sugg'] : $old["suggestion"];
$c = ($_POST['com'] != "") ? $_POST['com'] : $old["complain"];
$f = ($_POST['feed'] != "") ? $_POST['feed'] : $old["feedback"];


$sql = "update complaint_suggestion set suggestion = '$s', complain = '$c', feedback = '$f' where token_id = $t";
mysqli_query($conn, $sql);
header("Location: Home-page.php");

?>