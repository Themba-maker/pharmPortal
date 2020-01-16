<!DOCTYPE html>
<html lang="">
<?php
	session_start();
	include 'adminDAO.php';
	$funPatient = new FunPatient;

	function message($message) {
		?>
			<script>
				alert("<?php echo $message?>");
			</script>
		<?php
	}
	if(isset($_POST["register"])) {
		require_once('dbConnect.php');
		$idNumber = $_POST['idNumber'];
 		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$cellNumber = $_POST['cellNumber'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = "patient";
		message($funPatient->addUser($con,$idNumber,$fname, $lname, $cellNumber, $email, $password, $role));

	} elseif(isset($_POST["login"])) {
		$patientNo  = $_POST['pNumber'];
		$password = $_POST['password'];
		require_once('dbConnect.php');
		if(isset($_POST["patient"])){
			$role = 'patient';
			$result = $funPatient->signin($patientNo, $password, $con, $role);
			if($result["status"]) {
				header("Location:".$result["page"]);
			} else {
				message($result["message"]);
			}
		}
		
		if(isset($_POST["staff"])){
			$role = 'admin';
			$result = $funPatient->signin($patientNo, $password, $con, $role);
			if($result["status"]) {
				header("Location:".$result["page"]);
			} else {
				message($result["message"]);
			}
		}
	}
?>

        <head>
            <title>Home</title>
            <!-- for-meta-tags-->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="keywords" content="" />
            <script type="application/x-javascript">
                addEventListener("load", function() {
                    setTimeout(hideURLbar, 0);
                }, false);

                function hideURLbar() {
                    window.scrollTo(0, 1);
                }
            </script>
            <!-- //for-meta-tags-->
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
            <link href="css/JiSlider.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
            <link href="css/team.css" rel="stylesheet" type="text/css" media="all" />
            <link href="css/shop.css" rel="stylesheet" type="text/css" media="all" />
            <!-- font-awesome icons -->
            <link href="css/font-awesome.css" rel="stylesheet">

        </head>

        <body>
            <div class="main" id="home">
                <!-- banner -->
                <div class="header_of_web">
                    <div class="doctor_header_text">
                        <ul class="doctor_top_info_icons">
                            <li class="text-left"><i class="fa fa-home" aria-hidden="true"></i>Pretoria,Soshanguve 1685</li>
                            <li class="text-left"><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:info@ntuli_Dr.co.za">info@ntuli_Dr.co.za</a></li>
                            <li class="user-info"><i class="fa fa-user" aria-hidden="true"></i><a href="#" data-toggle="modal" data-target="#loginDialog">Sign in</li>
							<li class="user-info "><i class="fa fa-users" aria-hidden="true"></i><a href="#" data-toggle="modal" data-target="#createAccountDialog">Create Account</a></li>

                        </ul>
                    </div>
                    <div class="modal fade" id="loginDialog" role="dialog">
                        <div class="modal-dialog login-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Login</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="form">
                                            <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
												<div class="row margin-top">
													<div class="col-sm-6">
														<input type="radio" onclick="checkRadio(name)"  checked="true" name="patient" id="patient">patient</input>
													</div>
													<div class="col-sm-6">
														<input type="radio" onclick="checkRadio(name)" name="staff" id="staff">Staff</input>
													</div>
												</div>
												</br>
                                                <input type="number" name="pNumber" class="form-control patient" required="required" placeholder="Staff / patient Number" autofocus>
                                                <br>
                                                <input type="password" name="password" class="form-control" required="required" placeholder="Password">
                                                <button class="btn btn-login btn-block" name="login" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                                                <hr>

                                                <div class="login-social-link centered">
                                                    <p>Check our social network</p>
                                                    <button href="www.facebook.com" class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
                                                    <button href="www.twitter.com" class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="createAccountDialog" role="dialog">
                        <div class="modal-dialog create-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Create Account</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="form">
                                            <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
                                                <div class="row margin-top">
													<div class="col-md-6">
														<label>Identity Number:</label>
														<input type="number" name="idNumber" id="idNumber" onkeyup="validateStudentNumber()" class="form-control" required="required" placeholder="ID Number" autofocus>
														<label id="lblIdNumber"></label>
													</div>
													
								
                                                </div>
												<div class="row margin-top">
													<div class="col-md-6">
														<label>Firstname:</label>
														<input type="text" name="fname" id="fname" onkeyup="validateName()" class="form-control" required="required" placeholder="Name" autofocus>
														<label id="lblName"></label>
													</div>
													<div class="col-md-6">
														<label>Lastname:</label>
														<input type="text" name="lname" id="lname" class="form-control" onkeyup="validateLastname()" required="required" placeholder="Lastname" autofocus>
														<label id="lblLastname"></label>
													</div>
                                                </div>
												<div class="row margin-top">
													<div class="col-md-6">
														<label>Cell Number:</label>
														<input type="text" name="cellNumber" id="cellNO" onkeyup="validateCellNO()" class="form-control" required="required" placeholder="Cell Number" autofocus>
														<label id="lblCellNO"></label>
													</div>
													<div class="col-md-6">
														<label>Email:</label>
														<input type="email" name="email" id="email" onkeyup="validateEmail()" class="form-control" required="required" placeholder="Email" autofocus>
														<label id="lblEmail"></label>
													</div>
                                                </div>
												<div class="row margin-top">
													<div class="col-md-6">
														<label>Password:</label>
														<input type="password" name="password" id="password" onkeyup="validatePassword()" class="form-control" required="required" placeholder="Password" autofocus>
														<label id="lblPassword"></label>
													</div>
													<div class="col-md-6">
														<label>Confirm Password:</label>
														<input type="password" name="confirmPassword" id="confirmPassword" onkeyup="validatePasswordMatch()" class="form-control" required="required" placeholder="Confirm Password" autofocus>
														<label id="lblConfirm"></label>
													</div>
                                                </div>
												<div class="row col-md-offset-6">
													<div class="col-md-6 text-left">
														<button class="btn btn-login" name="register" type="submit"></i>Create Account</button>
													</div>
                                                </div>
                                                <hr>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-bottom">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="logo">
                                <h1><a class="navbar-brand" href="index.php">NTULI Pharmacy<i class="fa fa-users" aria-hidden="true"></i></a></h1>
                            </div>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse nav-wil " id="bs-example-navbar-collapse-1" >
                            <nav class="menu menu--sebastian ">
                                <ul id="m_nav_list" class="m_nav menu__list">
                                    <li class="m_nav_item menu__item menu__item--current" id="m_nav_item_1"> <a href="index.php" class="menu__link"> Home </a></li>
                                    <li class="m_nav_item menu__item" id="moble_nav_item_2"> <a href="about.php" class="menu__link"> Services </a> </li>
                                    <li class="m_nav_item menu__item" id="moble_nav_item_6"> <a href="contact.php" class="menu__link"> Contact Us</a> </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div>
            <!-- banner -->
            <div class="banner-silder">
                <div id="JiSlider" class="jislider">
                    <ul>
                        <li>
                            <div class="doctor-banner-top">

                                <div class="container">
                                    <div class="agileits-banner-info">

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="doctor-banner-top doctor-banner-top1">
                                <div class="container">
                                    <div class="agileits-banner-info">

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="doctor-banner-top doctor-banner-top2">
                                <div class="container">
                                    <div class="agileits-banner-info">

                                    </div>

                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- //banner -->

            <!-- about -->
            
			<!-- -->
						<div class="banner-bottom" id="about">
		<div class="container">
			<h2 class="doctor_heade_tittle_agile">Contact Us</h2>
		    <p class="sub_t_agileits">Want to hear from us? Leave a message</p>

           <div class="contact-top-agileits contact-background">
               <div class="col-md-12 contact-grid">
					<div class="contact-grid1 agileits-wlayouts">
						<div class="con-w3l-info text-center">
							
						   <h4>Address</h4>
						  <p>Soshanguve church Street<span>, Ivory Park 31</span></p>
						  <h4>Contact number</h4>
						  <p>011 4235 4125<span>, office number</span></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
				
			</div>
			
	    </div>
	</div>
			
			
			<!-- -->
            </div>

             
			 <div class="about-w3lsrow">

                    <div class="col-md-6 col-md-offset-3">
                        <img src="images/d2.jpg" alt=" " class="img-responsive img-responsive thumbnail">
                    </div>
                    <div class="clearfix"> </div>
                </div>
			 

         
<script src="js/jquery-2.2.3.min.js "></script>
<script src="js/MyImageSlider.js "></script>
<script src="js/validation.js "></script>
<script>
	$(window).load(function () {
		$('#JiSlider').JiSlider({color: '#fff', start: 3, reverse: true}).addClass('ff')
	})
	function checkRadio(name) {
		if(name == "patient"){
			document.getElementById("patient").checked = true;
			document.getElementById("staff").checked = false;

		} else if (name == "staff") {
			document.getElementById("staff").checked = true;
			document.getElementById("patient").checked = false;
		}
	}
</script>
<script src="js/bootstrap.js "></script>
<script src="scripts.js "></script>

<!-- //for bootstrap working -->
</body>
</html>