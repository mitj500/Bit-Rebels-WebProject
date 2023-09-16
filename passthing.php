<?php

require "db_connection.php";
if($con) {
    $password=$_GET['PASSWORD'];
    $query = "SELECT * FROM admin_credentials WHERE USERNAME = '".$_SESSION['user']."'";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    if($row['PASSWORD']==$password){
        return true;
    }
    else{
        return false;
    }
}
?>