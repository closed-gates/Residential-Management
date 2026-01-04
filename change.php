<?php

require_once('DBconnect.php');
require_once('session.php');
if (isset($_POST['uname']) && isset($_POST["nid"]) && isset($_POST['dob']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['district'])) {
    $u = $_POST['uname'];
    $n = $_POST["nid"];
    $dob = $_POST["dob"];
    $s = $_POST["street"];
    $c = $_POST["city"];
    $d = $_POST["district"];
    $m = $_POST["mem"];
    if ($m) {
        $sql = "update user_info set nid='$n',dob='$dob',street='$s',city='$c',district='$d' where nid = " . $SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
    } else {
        $sql = "update user_info set nid='$n',dob='$dob',street='$s',city='$c',district='$d,membership='YES',membership_refer='$mem' where nid = " . $SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
    }
    if ($SESSION['user_type'] == "admin") {
        $sql = "update admin set nid='$n' where nid = " . $SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
    }
    if ($SESSION['user_type'] == "landlord") {
        $sql = "update landlord set nid='$n' where nid = " . $SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
    }
    if ($SESSION['user_type'] == "renter") {
        $sql = "update renters set nid='$n' where nid = " . $SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
    }
    $SESSION['user_id'] = $n;
    $SESSION['username'] = $u;
    header("Location: Change-page.php");
}

?>