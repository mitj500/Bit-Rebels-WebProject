<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Items</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_item.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.php"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('shopping-bag', 'Manage Items', 'Manage Existing Items');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="by_name" placeholder="By Item Name" onkeyup="searchItem(this.value, 'name');">
            <!-- &emsp;<input type="text" class="form-control" id="by_generic_name" placeholder="By Generic Name" onkeyup="searchItem(this.value, 'generic_name');"> -->
            &emsp;<input type="text" class="form-control" id="by_supplier_name" placeholder="By Supplier Name" onkeyup="searchItem(this.value, 'supplier_name');">
            &emsp;<input type="text" class="form-control" id="by_category" placeholder="By Category" onkeyup="searchItem(this.value, 'category');">
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
            		<thead>
            			<tr>
            				<th style="width: 5%;">SL.</th>
            				<th style="width: 20%;">Item Name</th>
                    <!-- <th style="width: 10%;">Packing</th> -->
                    <!-- <th style="width: 30%;">Generic Name</th> -->
            				<th style="width: 20%;">Supplier</th>
                    <th style="width: 20%;">Description</th>
                    <th style="width: 15%;">Category</th>
                    <th id='row2' style="width: 15%;">Action</th>
                    <?php
                          require "php/db_connection.php";

                         $query2 = "SELECT * FROM admin_credentials WHERE USERNAME='".$_SESSION['user']."'";
                         $result2 = mysqli_query($con, $query2);
                         $row2=mysqli_fetch_array($result2);
                           if($row2['TYPE']=='admin'){
                           echo "<script>
                           document.getElementById('show3').style.display='block';</script>";
                          }
                           else{
                             echo "<script>
                             document.getElementById('show3').style.display='none';</script>";
                           } 
                           
                    ?>
            			</tr>
            		</thead>
            		<tbody id="item_div">
                  <?php
                    require 'php/manage_item.php';
                    showItem(0);
                  ?>
            		</tbody>
            	</table>
            </div>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
