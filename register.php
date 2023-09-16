<?php 
session_start();

	include("./connection/connection.php");
	include("./connection/functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$business_name = $_POST['business_name'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
        if (isset($_POST['radio1'])) {
            $selectedValue = $_POST['radio1'];

		if(!empty($username) && !empty($password))
		{

			//save to database
			$prequery ="SELECT * FROM admin_credentials where USERNAME='$username'";
            if(mysqli_num_rows(mysqli_query($con, $prequery))>0){
                header("Location: userregerror.php");
                
                echo '<script>document.getElementById("alr-exists").innerHTML="USERNAME EXISTS";</script>';
            }
            else{
                header("Location: home.php");
                
                $query = "insert into admin_credentials (USERNAME,PASSWORD,BUSINESS_NAME,EMAIL,ADDRESS,CONTACTNO,TYPE) values ('$username','$password','$business_name','$email', '$address', '$contact', '$selectedValue')";
                $_SESSION['user']=$username;
                mysqli_query($con, $query);
    
            }
			
			// header("Location: #");
			die;
		}else
		{
            header("Location: regerror.php");

            echo '<script>document.getElementById("error2").innerHTML="USERNAME EXISTS";</script>';

		}
	}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Username" name="username">
                                            <div id="alr-exists" style="color:red;"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Business Name" name="business_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="address"
                                        placeholder="Address" name="address">
                                </div>
                                <div class="form-group">
                                    <input type="number" pattern="{0-9}[10]" class="form-control form-control-user" id="contact"
                                        placeholder="Contact No" name="contact">
                                </div>
                                <div class="form-group" style="display:flex;align-items:center;justify-content:center;">
                                    <input type="radio" style="width:25%;margin:0 20px;padding:0;" class="form-control form-control-user" id="admin"
                                         name="radio1" value="admin">Admin
                                         <input type="radio" style="width:25%;margin:0 20px;" class="form-control form-control-user" id="staff"
                                         name="radio1" value="staff">Staff
                                </div>
                                <div id="error2" style="color:red;"></div>

                                <!--<div class="form-group">
                                    <p>Select Your Role: </p>
                                    <input type="radio" id="admin" name="role" value="admin">
                                    <label for="admin">Admin</label>
                                    <input type="radio" id="teacher" name="role" value="teacher">
                                    <label for="teacher">Teacher</label>
                                    <input type="radio" id="staffmember" name="role" value="staffmember">
                                    <label for="staffmember">Staff</label>
                                </div>-->
                                <hr>
                                <input href="login.html" class="btn btn-primary btn-user btn-block" type="submit">
                                </input>
                            </form>
                            <hr>
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

   <style>
        input[type="radio"]{
        margin: 0 15px 0 15px;
    }
    </style>

</body>

</html>