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
    if (!empty($m)) {
        echo "Not completed";
        $sql = "update user_info set nid='" . $n . "',name='" . $u . "',dob='" . $dob . "',street='" . $s . "',city='" . $c . "',district='" . $d . "',membership='YES',membership_refer='" . $mem . "' where nid = '" . $_SESSION['user_id'] . "'";
        mysqli_query($conn, $sql);
        echo "Not completed";
    } else {
        echo "Not completed";
        $sql = "update user_info set nid='" . $n . "',name='" . $u . "',dob='" . $dob . "',street='" . $s . "',city='" . $c . "',district='" . $d . "' where nid = '" . $_SESSION['user_id'] . "'";
        mysqli_query($conn, $sql);
        echo "Not completed";
    }
    if ($_SESSION['user_type'] == "admin") {
        $sql = "update admin set nid='$n' where nid = " . $_SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
        echo "Not completed";
    }
    if ($_SESSION['user_type'] == "landlord") {
        $sql = "update landlord set nid='$n' where nid = " . $_SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
        echo "Not completed";
    }
    if ($_SESSION['user_type'] == "renter") {
        $sql = "update renters set nid='$n' where nid = " . $_SESSION['user_id'] . "";
        mysqli_query($conn, $sql);
        echo "Not completed";
    }
    $_SESSION['user_id'] = $n;
    $_SESSION['username'] = $u;
    header("Location: account-page.php");
} else {
    die("You have to select");
}
?>