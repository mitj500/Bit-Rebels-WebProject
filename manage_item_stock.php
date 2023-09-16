<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Items Stock</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_item_stock.js"></script>
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
          createHeader('shopping-bag', 'Manage Items Stock', 'Manage Existing Items Stock');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="by_name" placeholder="By Item Name" onkeyup="searchItemStock(this.value, 'NAME');">
            <!-- &emsp;<input type="text" class="form-control" id="by_generic_name" placeholder="By Generic Name" onkeyup="searchItemStock(this.value, 'GENERIC_NAME');"> -->
            &emsp;<input type="text" class="form-control" id="by_suppliers_name" placeholder="By Supplier Name" onkeyup="searchItemStock(this.value, 'SUPPLIER_NAME');">
            &emsp;<button class="btn btn-danger font-weight-bold" onclick="searchItemStock('0', 'QUANTITY');">Out of Stock</button>
            &emsp;<button class="btn btn-warning font-weight-bold" onclick="searchItemStock('', 'EXPIRY_DATE');">Expired</button>
            &emsp;<button class="btn btn-success font-weight-bold" onclick="cancel();"><i class="fa fa-refresh"></i></button>\

          </div>


          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
            		<thead>
            			<tr>
            				<th style="width: 1%;">SL.</th>
            				<th style="width: 14%;">Item Name</th>
                    <!-- <th style="width: 5%;">Packing</th> -->
                    <!-- <th style="width: 14%;">Generic Name</th> -->
                    <th style="width: 10%;">Batch ID</th>
                    <th style="width: 8%;">Ex. Date (dd/mm/yy) 
                         </th>
            				<th style="width: 15%;">Supplier</th>
                    <th style="width: 7%;">Qty.</th>
                    <th style="width: 8%;">M.R.P.(<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                    <th style="width: 8%;">Rate (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                    <th style="width: 7%;">Location</th>
                 
                    <th id="show3" style="width: 100%;display:'revert';">Action</th>
            			</tr>
            		</thead>
                <?php
                          require "php/db_connection.php";

                         $query2 = "SELECT * FROM admin_credentials WHERE USERNAME='".$_SESSION['user']."'";
                         $result2 = mysqli_query($con, $query2);
                         $row2=mysqli_fetch_array($result2);
                           if($row2['TYPE']=='admin'){
                            echo "<script>
                            document.getElementById('show3').style.display='block';</script>";}
                            else{
                              echo "<script>
                              document.getElementById('show3').style.display='none';</script>";
                            }
                          
                       ?>
                <tbody id="item_stock_div">
                  <?php
                    require ('php/manage_item_stock.php');
                    if(isset($_GET['out_of_stock']))
                      echo "<script>searchItemStock('0', 'QUANTITY');</script>";
                    else if(isset($_GET['expired']))
                      echo "<script>searchItemStock('', 'EXPIRY_DATE');</script>";
                    else
                      showItemStock("0");
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
