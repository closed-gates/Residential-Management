<?php

require_once('DBconnect.php');
require_once('session.php');
$nid = (isset($_POST['oldnid'])) ? $_POST['oldnid'] : $_SESSION["nid"];
$old = mysqli_fetch_assoc(mysqli_query($conn, "select * from user_info where nid = '$nid'"));

$u = ($_POST['uname'] != "") ? $_POST["uname"] : $old["name"];
$n = ($_POST['nid'] != "") ? $_POST["nid"] : $old["nid"];
$dob = ($_POST['dob'] != "") ? $_POST["dob"] : $old["dob"];
$s = ($_POST['street'] != "") ? $_POST["street"] : $old["street"];
$c = ($_POST['city'] != "") ? $_POST["city"] : $old["city"];
$d = ($_POST['district'] != "") ? $_POST["district"] : $old["district"];
$m = isset($_POST['mem']) ? 1 : 0;
$memnum = (isset($_POST['memnum'])) ? $_POST["memnum"] : $old["membership_refer"];
if ($m) {
    $sql = "update user_info set nid='" . $n . "',name='" . $u . "',dob='" . $dob . "',street='" . $s . "',city='" . $c . "',district='" . $d . "',membership='YES',membership_refer='" . $memnum . "' where nid = '$nid'";
    mysqli_query($conn, $sql);

} else {

    $sql = "update user_info set nid='" . $n . "',name='" . $u . "',dob='" . $dob . "',street='" . $s . "',city='" . $c . "',district='" . $d . "' where nid = '$nid'";
    mysqli_query($conn, $sql);

}
if ($_SESSION['user_type'] == "admin" && !isset($_POST['oldnid'])) {
    $sql = "update admin set nid='$n' where nid = '$nid'";
    mysqli_query($conn, $sql);
}
if ($_SESSION['user_type'] == "admin" && isset($_POST['oldnid'])) {
    $tables = ["select * from admin where nid = '$nid'", "select * from landlord where nid = '$nid'", "select * from renters where nid = '$nid'"];


    foreach ($tables as $table) {
        $result = mysqli_query($conn, "" . $table . "");
        if ($table == $tables[0]) {
            $sql = "update admin set nid = '$n' where nid = '$nid'";
        } else if ($table == $tables[1]) {
            $sql = "update landlord set nid = '$n' where nid = '$nid'";
        } else {
            $sql = "update renters set nid = '$n' where nid = '$nid'";
        }
        if (mysqli_num_rows($result) > 0) {
            if (!mysqli_query($conn, $sql)) {
                echo "Error updating $table: " . mysqli_error($conn);
                exit;
            }
        }
    }
}
if ($_SESSION['user_type'] == "landlord") {
    $sql = "update landlord set nid='$n' where nid = '$nid'";
    mysqli_query($conn, $sql);

}
if ($_SESSION['user_type'] == "renter") {
    $sql = "update renters set nid='$n' where nid = '$nid'";
    mysqli_query($conn, $sql);

}
if (!isset($_POST['oldnid'])) {
    $_SESSION['user_id'] = $n;
}
$_SESSION['username'] = $u;
header("Location: account-page.php");

?>