<?php
require_once("DBconnect.php");

if (isset($_POST['pin']) && isset($_POST['price']) && isset($_POST['flat_type'])) {
    $p = $_POST['pin'];
    $ut = $_POST['util'];
    $f = $_POST['is_furnished'] ? 1 : 0;
    $pr = $_POST['price'];
    $t = $_POST['flat_type'];
    $sql = "update flat_plot_rent_selling set pin ='" . $p . "',utilities='" . $u . "',is_furnished='" . $f . "',price='" . $pr . "',flat_type='" . $t . "' where pin = '" . $_SESSION['pin'] . "'";
    mysqli_query($conn, $sql);

} else {
    die("Have to select pin,price,flat_type");
}
?>