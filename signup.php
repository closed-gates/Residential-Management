<?php

require_once('DBconnect.php');

if(isset($_POST['uname']) && isset($_POST["nid"]) && isset($_POST['dob']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['district']) && isset($_POST['user'])){
    $u = $_POST['uname'];
    $n = $_POST["nid"];
    $dob = $_POST["dob"];
    $s = $_POST["street"];
    $c = $_POST["city"];
    $d = $_POST["district"];
    $m = $_POST["mem"];
    $us = $_POST['user'];
    $sql = "select * from user_info where nid = '$n'";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) !=0){
        echo "User already exists";
        sleep(2);
        header("Location: Signup-page.php");

    }   
    else{
        if ($m != 0){
            $sql = "insert into user_info values('$n','$u','$dob','$s','$c','$d','Yes','$m')";
            mysqli_query($conn,$sql);
        }
        else{
            $sql = "insert into user_info values('$n','$u','$dob','$s','$c','$d','NO','NULL')";
            mysqli_query($conn,$sql);
        }
        header("Location: Home-page.php");
    }
}




?>