<?php

require_once('DBconnect.php');
require_once('session.php');

$u = $_POST['uname'];
$n = $_POST["nid"];
$dob = $_POST["dob"];
$s = $_POST["street"];
$c = $_POST["city"];
$d = $_POST["district"];
$m = $_POST["mem"] ?? "NO";
$p = $_POST["phn"];
$allowedTypes = ['admin', 'landlord', 'renter'];
$us = $_POST['userselect'] ?? '';
if (!in_array($us, $allowedTypes, true)) {
    die("Invalid user type selected");
}
$sql = "select * from user_info where nid = '$n'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 0) {
    header("Location: Signup-page.html?error=Userexists");
    exit();

} else {
    if ($m != 'NO') {
        $sql = "insert into user_info values('$n','$u','$dob','$s','$c','$d','YES','$m')";
    } else {
        $sql = "insert into user_info(nid,name,dob,street,city,district,membership) values('$n','$u','$dob','$s','$c','$d','$m')";
    }
    mysqli_query($conn, $sql);
    if ($us == 'admin') {
        $r = $_POST['admin_Role'];
        $dept = $_POST['admin_Department'];
        $e = $_POST['admin_Email'];
        $sql = "insert into admin values('$n','$r','$dept','$u','$e')";
    } else if ($us == 'landlord') {
        $l = $_POST['landlord_is_verified'] ? 1 : 0;
        $sql = "insert into landlord values('$n','$l','0')";
    } else {
        $o = $_POST['renter_Occupation'];
        $is = $_POST['renter_is_student'] ? 1 : 0;
        $rhc = $_POST['renter_Rental_History'];
        $sql = "insert into renters(nid,occupation,is_student,rental_history_count) values('$n','$o','$is','$rhc')";
    }
    mysqli_query($conn, $sql);
    session_regenerate_id(true);
    $_SESSION['user_id'] = $n;
    $_SESSION['username'] = $u;
    $_SESSION['user_type'] = $us;
    header("Location: Home-page.php");
    exit();
}





?>