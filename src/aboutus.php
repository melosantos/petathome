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
	<title>Meow Site</title>

	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="slideshow.css">

	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
</head>




	<div class="signup-bg">
		<img src="../img/blah.jpg" class="sign-up-ming">
</div>


	<div class="topnav">
	<img src="../img/logo.png" width="65px" class="logo">
		<a href='index.php' id="brand">Pet@Home</a>

		<?php
			if ($_SESSION['user_type'] == 1) {
				echo "<a href='administrator.php'>Administer</a>";
			}
		?>
		<div  id="right">
			<a href='authentication/login.php'>Log In</a>
			<a href='registration/register.php'>Sign-Up</a>
		</div>

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