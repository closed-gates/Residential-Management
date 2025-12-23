<?php

require_once('DBconnect.php');

if(isset($_POST['fname']) && isset($_POST["nid"])){
    $u = $_POST['fname'];
    $n = $_POST["nid"];
    $sql = "select * from user where name = '$u' and nid = '$n'";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) !=0){
        $stmt = $conn->prepare("insert into user_info ('nid','name') values('$u','$n')");
        $stmt->bind_param("si",$u,$n);
        if ($stmt->execute()){
            echo"Updated succesfullly";

        }
        else{
            echo"error updating".$stmt->error;
        }
        echo "Welcome";

    }
    else{
        echo "Username or nid is wrong";
    }
}





?>