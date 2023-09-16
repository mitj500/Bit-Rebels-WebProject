<?php
        require "php/db_connection.php";

        $query2 = "SELECT * FROM admin_credentials WHERE USERNAME='".$_SESSION['user']."'";
        $result2 = mysqli_query($con, $query2);
        $row2=mysqli_fetch_array($result2);
        if($row2['TYPE']=='admin'){
        return true;}
        else{
      return false;
        }

?>