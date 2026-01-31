<?php
require_once("DBconnect.php");
require_once("session.php");


$old = mysqli_fetch_assoc(mysqli_query($conn, "select utilities,price_rent,renting_type from flat_plot_rent_selling where pin = '" . $_SESSION["pin"] . "'"));

$p = ($_POST['pin'] != "") ? $_POST['pin'] : $_SESSION["pin"];

$ut = ($_POST['util'] != "") ? $_POST['util'] : $old["utilities"];

$f = isset($_POST['is_furnished']) ? 1 : 0;

$pr = ($_POST['price'] != "") ? $_POST['price'] : $old["price_rent"];

$t = ($_POST['flat_type'] != "") ? $_POST['flat_type'] : $old["renting_type"];

$sql = "update flat_plot_rent_selling set pin ='" . $p . "',utilities='" . $ut . "',is_furnished='" . $f . "',price_rent='" . $pr . "',renting_type='" . $t . "' where pin = '" . $_SESSION['pin'] . "'";

if (!mysqli_query($conn, $sql)) {
    echo mysqli_error($conn);
    exit;
}
$tables = ['payment', 'review', 'can_occupy', 'owns'];

$oldPin = $_SESSION['pin'];
$newPin = $p;

foreach ($tables as $table) {
    $sql = "UPDATE $table SET pin = '$newPin' WHERE pin = '$oldPin'";

    if (!mysqli_query($conn, $sql)) {
        echo "Error updating $table: " . mysqli_error($conn);
        exit;
    }
}
$_SESSION["pin"] = $p;
header("Location: Home-page.php");
exit();


?>