<?php

require_once('DBconnect.php');


if(isset($_POST["nid"]) && isset($_POST['fname'])){
    $u = $_POST['fname'];
    $n = $_POST["nid"];
    $sql = "select * from user_info where name = '$u' and nid = '$n'";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) !=0){
        header("Location: Home-page.html");

    }
    else{
        echo "Username or nid is wrong";
        header("Location: website.html");
    }
}






?>