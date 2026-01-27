<?php
require_once("DBconnect.php");
require_once("session.php");


$p = ($_POST['pin'] != "") ? $_POST['pin'] : $_SESSION["pin"];
$ut = ($_POST['util'] != "") ? $_POST['util'] : mysqli_fetch_assoc(mysqli_query($conn, "select utilities from flat_plot_rent_selling where pin = '" . $_SESSION['pin'] . "'"))["utilities"];
$f = $_POST['is_furnished'] ? 1 : 0;
$pr = ($_POST['price'] != "") ? $_POST['price'] : mysqli_fetch_assoc(mysqli_query($conn, "select price_rent from flat_plot_rent_selling where pin = '" . $_SESSION['pin'] . "'"))["price_rent"];
$t = ($_POST['flat_type'] != "") ? $_POST['flat_type'] : mysqli_fetch_assoc(mysqli_query($conn, "select renting_type from flat_plot_rent_selling where pin = '" . $_SESSION['pin'] . "'"))["renting_type"];
$sql = "update flat_plot_rent_selling set pin ='" . $p . "',utilities='" . $ut . "',is_furnished='" . $f . "',price_rent='" . $pr . "',renting_type='" . $t . "' where pin = '" . $_SESSION['pin'] . "'";
mysqli_query($conn, $sql);
echo "" . mysqli_error($conn) . "";
$_SESSION["pin"] = $p;
header("Location: Home-page.php");
exit();


?>