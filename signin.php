<?php

require_once('DBconnect.php');

if(isset($_POST['fname']) && isset($_POST["nid"])){
    $u = $_POST['fname'];
    $n = $_POST["nid"];
    $sql = "select * from user where name = '$u' and nid = '$n'";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) !=0){
        echo "Welcome";

    }
    else{
        echo "Username or nid is wrong";
    }
}





?>