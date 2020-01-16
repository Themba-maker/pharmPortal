<?php
	session_start();
	$role = $_SESSION["role"];
	$patientCode = $_SESSION["patientCd"];
	include 'adminDAO.php';
	$funPatient = new FunPatient;
	$_SESSION["amount"] = 0;
	require_once('dbConnect.php');
	function message($message){
		?><script>alert("<?php echo $message?>");</script><?php
	}
	if($role != "patient"){
		header("Location:index.php");
	}
	//Booking date
			$day= date("d-M-Y");
	if(isset($_POST["appointDate"]))
	{
		$day=$_POST["appointDate"];
	}
//booking
	
	if(isset($_POST["slot1"])){
		$date = date("d-M-Y");
		$time = "8:00am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	} else if (isset($_POST["slot1"])){
		$date = date("d-M-Y");
		$time = "8:20am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	} else if (isset($_POST["slot2"])){
		$date = date("d-M-Y");
		$time = "8:40am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	} else if (isset($_POST["slot4"])){
		$date = date("d-M-Y");
		$time = "9:00am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot5"])){
		$date = date("d-M-Y");
		$time = "9:20am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot6"])){
		$date = date("d-M-Y");
		$time = "9:40am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot7"])){
		$date = date("d-M-Y");
		$time = "10:00am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot8"])){
		$date = date("d-M-Y");
		$time = "10:00am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot9"])){
		$date = date("d-M-Y");
		$time = "10:20am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot10"])){
		$date = date("d-M-Y");
		$time = "10:40am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot11"])){
		$date = date("d-M-Y");
		$time = "11:00am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot12"])){
		$date = date("d-M-Y");
		$time = "11:20am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot13"])){
		$date = date("d-M-Y");
		$time = "11:40am";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot14"])){
		$date = date("d-M-Y");
		$time = "12:00pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot15"])){
		$date = date("d-M-Y");
		$time = "1:00pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot16"])){
		$date = date("d-M-Y");
		$time = "1:20pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot17"])){
		$date = date("d-M-Y");
		$time = "1:40pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot18"])){
		$date = date("d-M-Y");
		$time = "2:00pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot19"])){
		$date = date("d-M-Y");
		$time = "2:20pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}
	else if (isset($_POST["slot20"])){
		$date = date("d-M-Y");
		$time = "2:40pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot21"])){
		$date = date("d-M-Y");
		$time = "3:00pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}else if (isset($_POST["slot22"])){
		$date = date("d-M-Y");
		$time = "3:20pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}
	else if (isset($_POST["slot23"])){
		$date = date("d-M-Y");
		$time = "3:40pm";
		message($funPatient->addBooking($con,$date,$time,$patientCode));
	}
//---------------------
	if(isset($_POST["addTransaction"])){
		require_once('dbConnect.php');
		$category = $_POST["category"];
		$itemName = $_POST["item"];
		$price = $_POST["amountSpent"];
		$purchaseDate = date("d-M-Y");
		$month = date("M-Y");
		$balance = $_SESSION["amount"];
		$studentNumber = $_SESSION["studentNumber"];
		if ($balance >= $price) {
			$studentNumber = $_SESSION["studentNumber"];
			$funPatient->withDrawMoney($con,$studentNumber,$price, $month);
			$funPatient->getMyBalance($con,$_SESSION["studentNumber"], $month);
			message($funPatient->addTransaction($con, $studentNumber, $purchaseDate, $category, $itemName, $price, $month));
		} else {
			message("Insufficient funds");
		}
	}
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Booking</title>
<!-- for-meta-tags-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript">
addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-meta-tags-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/JiSlider.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/team.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/admin.css" rel="stylesheet" type="text/css" media="all" />
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
									<li class="text-left"><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:info@NTULI_Dr.co.za">info@NTULI_Dr.co.za</a></li>
									<li class="user-info"><i class="fa fa-user" aria-hidden="true"></i><a href="clearSession.php">Logout</li>
								</ul>
						</div>
						<div class="clearfix"> </div>
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
						<h1><a class="navbar-brand" href="index.php">NTULI PHARMACY<i class="fa fa-users" aria-hidden="true"></i></a></h1>
					</div>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--sebastian">
					<ul id="m_nav_list" class="m_nav menu__list">
						<li class="m_nav_item menu__item" id="moble_nav_item_4"> <a href="index.php" class="menu__link">Home</a> </li>
						<li class="m_nav_item menu__item" id="moble_nav_item_4"> <a href="about.php" class="menu__link">About Us</a> </li>
						<li class="m_nav_item menu__item" id="moble_nav_item_6"> <a href="contact.php" class="menu__link"> Contact Us </a> </li>
					</ul>
				</nav>

				</div>
				<!-- /.navbar-collapse -->
			</nav>
	 </div>
</div>
<!-- banner -->
<!-- banner1 -->
	<div class="banner1 jarallax">
		<div class="container">
			<marquee><h3 class="page-heading"><?php echo $_SESSION["firstname"] . ' ' . $_SESSION["lastname"];?> Welcome to Doctor NTULI Pharmacy</h3></marquee>
		</div>
	</div>

	<div class="band-devider">
		<div class="container">
			<ul>
				<li><a href="student.php">Home</a><i>|</i></li>
				<li><a><?php echo "Patient Number  ".$_SESSION["patientCd"];?></a></li>
			</ul>
		</div>
	</div>
<!-- //banner1 -->


<!-- //banner -->

<!-- about -->
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-12">
				<aside class="quick-links">
					<table class="table-responsive">
						<tr class="quick-links-header">
							<td>Navigation links</td>
					    </tr>
						<tr>
							<td><li><a class="btn"  href="patient.php">Home</a></li></td>
						</tr>
						<tr>
							<td><li><a class="btn"  href="bookAppointment.php">Book Appointment</a></li></td>
						</tr>
						<tr>
							<td><li><a class="btn"  href="allPatients.php">View Appointments</a></li></td>
						</tr>
					</table>
				</aside>
			</div>
			
			

			<div class="col-md-8 col-xs-12">
				<article class="admin-dashboard margin-top">
					<div class="panel panel-primary">
						<div class="panel-heading"><h5 class="thin">Make a Booking</h5></div>
							
							<div class="panel-body">
								 <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" enctype="multipart/form-data" method="POST">
								<div class="col-md-12">
											 <label>Pick a time Slot:</label>
 										<input type="date"  name="appointDate" id="appointDate" onkeyup="validateDOB()" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="select date for appointment" >
								        </div>
								<div class="row">
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">8:00am</h4>
													<button type="submit" name="slot1" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">8:20am</h4>
													<button type="submit" name="slot2" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">8:40am</h4>
													<button type="submit" name="slot3" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">9:00am</h4>
													<button type="submit" name="slot4" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">9:20am</h4>
													<button type="submit" name="slot5" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">9:40am</h4>
													<button type="submit" name="slot6" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">10:00am</h4>
													<button type="submit" name="slot7" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">10:20am</h4>
													<button type="submit" name="slot8" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">10:40am</h4>
													<button type="submit" name="slot9" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">11:00am</h4>
													<button type="submit" name="slot10" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">11:20pm</h4>
													<button type="submit" name="slot11" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">11:40am</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">12:00pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">1:00pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">1:20pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">1:40pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">2:00pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">2:20pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">2:40pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">3:00pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">3:20pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
											<div class="col-md-3">
												<div class="car-vew">
													<h4 class="heading">3:40pm</h4>
													<button type="submit" name="slot12" class="btn btn-md btn-success">Book Now</button>
												</div>
											</div>
										</div>
								</form> 
							</div>
					</div>
				</article>
			</div>
		</div>
	</div>

<div class="service-w3l jarallax" id="service">
	<div class="container">

	</div>
</div>

<!-- stats -->
	<div class="stats_inner jarallax" id="stats">
	    <div class="container">
			<div class="doctor_stats_grid">

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //stats -->

<!-- footer -->
	 <div class="footer">
                <div class="container">
                    <div class="footer_copy ">
				<div class="w3agile_footer_grids ">

					<div class="clearfix "> </div>
				</div>
			</div>
			<div class="w3_agileits_copy_right_social ">
				<div class="col-md-3 agileits_w3layouts_copy_right ">

				</div>
				<div class="clearfix "> </div>
			</div>
<!-- //footer -->
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
 <!-- js -->
<script src="js/jquery-2.2.3.min.js"></script>

<script src="js/ziehharmonika.js"></script>
<script>
$(document).ready(function() {
		$('.ziehharmonika').ziehharmonika({
			collapsible: true,
			prefix: ''
		});
	});
</script>
<!-- stats -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
		<script>
			$('.counter').countUp();
		</script>
<!-- //stats -->
	<!-- Gallery-Tab-JavaScript -->
			<script src="js/cbpFWTabs.js"></script>
			<script>
				(function() {
					[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
						new CBPFWTabs( el );
					});
				})();
			</script>
		<!-- //Gallery-Tab-JavaScript -->


<!-- Swipe-Box-JavaScript -->
			<script src="js/jquery.swipebox.min.js"></script>
				<script type="text/javascript">
					jQuery(function($) {
						$(".swipebox").swipebox();
					});
			</script>
		<!-- //Swipe-Box-JavaScript -->

<!-- flexSlider -->
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
  </script>
<!-- //flexSlider -->


<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script src="js/validation.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>

	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>
