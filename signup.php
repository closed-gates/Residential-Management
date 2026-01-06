<?php

require_once('DBconnect.php');
require_once('session.php');
if (isset($_POST['uname']) && isset($_POST["nid"]) && isset($_POST['dob']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['district']) && isset($_POST['userselect'])) {
    $u = $_POST['uname'];
    $n = $_POST["nid"];
    $dob = $_POST["dob"];
    $s = $_POST["street"];
    $c = $_POST["city"];
    $d = $_POST["district"];
    $m = $_POST["mem"];
    $p = $_POST["phn"];
    $allowedTypes = ['admin', 'landlord', 'renter'];
    $us = $_POST['userselect'] ?? '';
    if (!in_array($us, $allowedTypes, true)) {
        die("Invalid user type selected");
    }
    $sql = "select * from user_info where nid = '$n'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) != 0) {
        header("Location: Signup-page.html?error=exists");
        exit();

    } else {
        if ($m != NULL) {
            $sql = "insert into user_info values('$n','$u','$dob','$s','$c','$d','Yes','$m')";
            mysqli_query($conn, $sql);
        } else {
            $sql = "insert into user_info(nid,name,dob,street,city,district,membership) values('$n','$u','$dob','$s','$c','$d','NO')";
            mysqli_query($conn, $sql);
        }
        $_SESSION['user_id'] = $n;
        $_SESSION['username'] = $u;
        if ($us == 'admin') {
            $r = $_POST['admin_Role'];
            $dept = $_POST['admin_Department'];
            $e = $_POST['admin_Email'];
            $sql = "insert into admin values('$n','$r','$dept','$u','$e')";
            mysqli_query($conn, $sql);
        } else if ($us == 'landlord') {
            $l = $_POST['landlord_is_verified'] ? 1 : 0;
            if ($l) {
                $l = 1;
            } else {
                $l = 0;
            }
            $sql = "insert into landlord values('$n','$l','0')";
            mysqli_query($conn, $sql);
        } else {
            $o = $_POST['renter_Occupation'];
            $is = $_POST['renter_is_student'] ? 1 : 0;
            $crs = $_POST['renter_current_rent_status'] ? 1 : 0;
            $rhc = $_POST['renter_Rental_History'];
            $sql = "insert into renters values('$n','$o','$is','$crs','$rhc')";
            mysqli_query($conn, $sql);
        }
        $_SESSION['user_type'] = $us;
        session_regenerate_id(true);
        header("Location: Home-page.php");

    }
}




?>