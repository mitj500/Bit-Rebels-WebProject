<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard - Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <?php include "sections/sidenav.php"; ?>
    <div class="container-fluid">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('home', 'Dashboard', 'Home');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

            <?php
              function createSection1($location, $title, $table) {
                require 'php/db_connection.php';
                if($title=="Total Supplier")
                  $query = "SELECT * FROM $table where USERNAME='".$_SESSION['user']."'";
                else
                  $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.NAME = medicines_stock.NAME where USERNAME='".$_SESSION['user']."'";
                // if($title == "Out of Stock")
                //   $query = "SELECT * FROM $table WHERE QUANTITY = 0";

                $result = mysqli_query($con, $query);
                $count = mysqli_num_rows($result);


                if($title == "Expired") {
                  // logic
                  $count = 0;
                  while($row = mysqli_fetch_array($result)) {
                    $exp_date=date_create_from_format('d/m/y', $row['EXPIRY_DATE']);
                    if(!$exp_date==false){
                        $currentDateTime = new DateTime();
                        $interval = $currentDateTime->diff($exp_date);
                    }
                    if($interval->format('%a')<0){
                        $count++;
                    }
                    }
                  }
                

                echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats">
                      <a class="text-dark text-decoration-none">
                        <span class="h4">'.$count.'</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">'.$title.'</div>
                      </a>
                    </div>
                  </div>
                ';
              }
              
              createSection1('manage_supplier.php', 'Total Supplier', 'suppliers');
              createSection1('manage_item.php', 'Total Items', 'medicines');
              createSection1('manage_item_stock.php?out_of_stock', 'Out of Stock', 'medicines_stock');
              createSection1('manage_item_stock.php?expired', 'Expired', 'medicines_stock');
              
            ?>

          </div>

         <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
            <div class="todays-report">
              <div class="h5">Your Report</div>
              <table class="table table-bordered table-striped table-hover">
                <tbody>
                  <?php
                    require 'php/db_connection.php';
                    if($con) {
                      $date = date('Y-m-d');
                  ?>
                  
                  <tr>
                    <?php
                      //echo $date;
                      $total = 0;
                      $query = "SELECT RATE FROM medicines_stock";
                      $query = "SELECT RATE FROM medicines INNER JOIN medicines_stock ON medicines.NAME = medicines_stock.NAME where USERNAME='".$_SESSION['user']."'";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['RATE'];
                    }
                    ?>
                    <th>Total Purchase</th>
                    <th class="text-danger">Rs. <?php echo $total; ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <hr style="border-top: 2px solid #ff5252;">

        <div class="row">

          <?php
            function createSection2($icon, $location, $title) {
              echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;" onclick="location.href=\''.$location.'\'">
              		<div class="dashboard-stats" style="padding: 30px 15px;">
              			<div class="text-center">
                      <span class="h1"><i class="fa fa-'.$icon.' p-2"></i></span>
              				<div class="h5">'.$title.'</div>
              			</div>
              		</div>
                </div>
              ';
            }
            
            createSection2('shopping-bag', 'add_item.php', 'Add New Item');
            createSection2('group', 'add_supplier.php', 'Add New Supplier');

          ?>

        </div>
        <!-- form content end -->

        <hr style="border-top: 2px solid #ff5252;">

      </div>
    </div>
  </body>
</html>