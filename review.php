<?php

require_once('DBconnect.php');
require_once('session.php');
$p = $_POST['pin'];
$s = $_POST["sugg"];
$c = $_POST["com"];
$f = $_POST["feed"];
$t = $_POST['token'];
$r = $p + $t;
$n = $_POST['nid'];
$sql = "insert into complaint_suggestion values('$t','$s','$c','$f')";
$sql2 = "insert into review values($n,$t,$r,$p)";
mysqli_query($conn, $sql);
mysqli_query($conn, $sql2);
header("Location: Home-page.php");

?>