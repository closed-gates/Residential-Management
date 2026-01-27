<?php
require_once('DBconnect.php');
require_once('session.php');

$p = $_POST['pin'];
$ut = ($_POST['util'] != "") ? $_POST["util"] : "";
$f = $_POST['is_furnished'] ? 1 : 0;
$pr = $_POST['price'];
$t = $_POST['flat_type'];
$sql = "insert into flat_plot_rent_selling values('$p','$ut','$f','$pr','$t')";
mysqli_query($conn, $sql);
if (isset($_POST['nid'])) {
    $n = $_POST['nid'];
    $sql = "select * from landlord where nid = '$n'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        die('Not a valid Landlord nid');
    } else {
        $sql = "insert into owns values('$n','$p')";
    }
} else {
    $sql = "insert into owns values('" . $_SESSION['user_id'] . "','$p')";
}
mysqli_query($conn, $sql);
header("Location: Home-page.php");

?>