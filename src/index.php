<?php
include '../config/config.php';

$_SESSION['user_type'] = 0;

if ($_SESSION['fname'] != "") {
    echo "Welcome, " . $_SESSION['fname'] . " " . $_SESSION['lname'];
    echo "<a href='index.php?logout=1'>Logout</a>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pet At Home</title>

	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="slideshow.css">

	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
	<div class="topnav">
	<img src="../img/logo.png" width="65px" class="logo">
		<a href='index.php' id="brand">Pet@Home</a>

		<?php
			if ($_SESSION['user_type'] == 1) {
				echo "<a href='administrator.php'>Administer</a>";
			}
		?>
		<div id="right">
			<a href='authentication/login.php'>Log In</a>
			<a href='registration/register.php'>Sign-Up</a>
		</div>

	</div>

	<!-- Slideshow container -->
	<div class="slideshow-container">

		<!-- Full-width images with number and caption text -->
		<div class="mySlides fade">
			<div class="numbertext">1 / 3</div>
			<div class="ming">
				<img src="../img/cover1.png">
			</div>
		</div>

		<div class="mySlides fade">
			<div class="numbertext">2 / 3</div>	
			<div class="ming">
				<img src="../img/cover2.png" class="ming2-img">
			</div>
		</div>

		<!-- Next and previous buttons -->
		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>
	<br>

	<!-- The dots/circles -->
	<div style="text-align:center">
		<span class="dot" onclick="currentSlide(1)"></span>
		<span class="dot" onclick="currentSlide(2)"></span>
	</div>
	<br>
	<script type="text/javascript" src="slideshow.js"></script>
	<div class="about-container">
		<img src="../img/pets1.png" width="400px" class="about-ming">
		<p class="about-adopt">
			Adoption is one of the best ways to help give an abandoned pet for that matter a new life. Change a life today and adopt an animal because the best breed are the ones in need.
		</p>
	</div>
	<div class="lastmain-container">
		<div class="lastmain">
			<p class="no-margin"><b>
			Kvinde Software Development Company  ©  All Rights Reserved 2018<br>
			<a href='index.php' class="ibang-kulay">Home ||</a>
			<a href='aboutus.php' class="ibang-kulay">About Us ||</a>
			<a href='registration/contactus.php' class="ibang-kulay">Contact Us</a>		
			</b></p>
		</div>
	</div>
</body>
</html>