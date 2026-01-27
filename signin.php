<?php
require_once('DBconnect.php');
require_once('session.php');


$u = $_POST['fname'];
$n = $_POST['nid'];

// 1️⃣ Verify user exists
$sql = "SELECT * FROM user_info WHERE nid='$n'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
    header("Location: website.html?error=invalidUser");
    exit();
}

// 2️⃣ Set basic session
$_SESSION['user_id'] = $n;
$_SESSION['username'] = $u;

// 3️⃣ Detect user type (ONE QUERY EACH)
if (mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM admin WHERE nid='$n'")) > 0) {
    $_SESSION['user_type'] = 'admin';
} elseif (mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM landlord WHERE nid='$n'")) > 0) {
    $_SESSION['user_type'] = 'landlord';
} elseif (mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM renters WHERE nid='$n'")) > 0) {
    $_SESSION['user_type'] = 'renter';

    // else should'nt be used but here anyway
} else {
    $_SESSION['user_type'] = 'unknown';
}

// 4️⃣ Redirect
header("Location: Home-page.php");
exit();

?>