<?php

require_once('DBconnect.php');
require_once('session.php');
$p = $_POST['pin'];
$n = $_POST['nid'];
$s = $_POST["sugg"];
$c = $_POST["com"];
$f = $_POST["feed"];
$t = $_POST['token'];
$r = $p + $t;
if ($_SESSION['user_type'] == "landlord") {
    $sql = "select nid from owns where pin = $p";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if ($row['nid'] == $n) {
        die("You cannot review the flat you own");
    }
}

$sql = "insert into complaint_suggestion values('$t','$s','$c','$f')";
$sql2 = "insert into review values($n,$t,$r,$p)";
mysqli_query($conn, $sql);
mysqli_query($conn, $sql2);
header("Location: Home-page.php");

?>