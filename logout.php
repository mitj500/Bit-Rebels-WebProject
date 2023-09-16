<?php
  require "php/db_connection.php";

  if($con) {
    if(isset($_SESSION['user'])){
      unset($_SESSION['user']);
    }
  }
  header("Location: login.php");
  die;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Logout</title>
    <script src="js/restrict.js"></script>
  </head>
  <body>

  </body>
</html>
