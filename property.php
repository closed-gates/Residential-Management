<?php
require_once('DBconnect.php');
require_once('session.php');
if (isset($_POST['pin']) && isset($_POST['price']) && isset($_POST['flat_type'])) {
    $p = $_POST['pin'];
    $ut = $_POST['util'];
    $f = $_POST['is_furnished'] ? 1 : 0;
    $pr = $_POST['price'];
    $t = $_POST['flat_type'];
    $sql = "insert into flat_plot_rent_selling values('$p','$ut','$f','$pr','$t')";
    $result = mysqli_query($conn, $sql);
    $sql = "insert into owns values('" . $_SESSION['user_id'] . "','$p')";
    $result = mysqli_query($conn, $sql);
    header("Location: Home-page.php");

} else {
    die("Have to select pin,price,flat_type");
}
?>