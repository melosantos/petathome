<?php
include 'config.php';
include 'ChromePhp.php';

//checking for login details page security
	 // if($_SESSION['user_id'] == ""){
	 // 	echo "Your are not allowed here!!!";
	
	  ?>	
	 <!-- <script> alert("bawal dito"); </script>
	<meta http-equiv="refresh" content="0;url=index.php"/>
-->
	 // <?php
	 // 		// header("location: index.php");
	 	//} 


if ($_SESSION['fname'] != "") {
    echo '<div class="midnav">';
    echo "Welcome, " . $_SESSION['fname'] . " " . $_SESSION['lname'];
    echo '</div>';
    echo $_SESSION['user_type'];

}

//ChromePhp::log('FROM CHOOSE USER ID:');
//ChromePhp::log($_SESSION['user_id']);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Adopt or Donate</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="choose.css">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<body>
	<div class="topnav">
		<a href='index.php?logout=1'>Logout</a>
		<?php
if ($_SESSION['user_type'] == 1) {
    echo "<a href='administrator.php'>Adminx</a>";
}
?>
		<a href='profile.php'>
			<img border="0" alt="profile" src="img/p1.png" width="35" height="35">
		</a>
	</div>

		<div class="choose-container">
			<div class="card-choice">
				<div class="card-image">
					<img src="img/adopt.png" alt="adopt">
				</div>
				<div class="card-action">
					<a href="#">I want to adopt!</a>
				</div>

			</div>

			<div class="card-choice">
				<div class="card-image">
					<img src="img/donate.png">
				</div>
				<div class="card-action">
					<a href="petreg.php">I want to donate!</a>
				</div>

			</div>
		</div>


	</body>
	</html>