<?php

require_once('DBconnect.php');
session_start();

if(isset($_POST["nid"]) && isset($_POST['fname'])){
    $u = $_POST['fname'];
    $n = $_POST["nid"];
    $sql = "select * from user_info where name = '$u' and nid = '$n'";
    $_SESSION['user_id']   = $n;     
    $_SESSION['username']  = $u;
    $sqla = "select u.nid from user_info u join admin a where u.nid = a.nid";
    $sqlb = "select u.nid from user_info u join landlord l where u.nid = l.nid";
    $sqlc = "select u.nid from user_info u join renters r where u.nid = r.nid";
    $resa = mysqli_query($conn,$sqla);
    $resl = mysqli_query($conn,$sqlb);
    $resr = mysqli_query($conn,$sqlc);
    if (mysqli_num_rows($resa) != 0){
        $row = mysqli_fetch_assoc($resa);
        $_SESSION['user_type'] = 'Admin';

    }
    else if(mysqli_num_rows($resl) != 0){
        $_SESSION['user_type'] = 'Landlord';
    }
    else{
        $_SESSION['user_type'] = 'Renter';
    }
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) !=0){
        header("Location: Home-page.php");

    }
    else{
        echo "Username or nid is wrong";
        header("Location: website.html");
    }
}






?>