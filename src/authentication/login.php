<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';

$usernameLogin = $_POST['uName'];
$passwordLogin = $_POST['psw'];

if ($_POST['login']) {
	$conn = new mysqli($host, $username, $password, $db);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	else {
		if ($usernameLogin != "") {
			$sqlSelect = "SELECT * from tbl_users WHERE username='$usernameLogin'";
			$result = $conn->query($sqlSelect);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				if ($row['status'] == "active") {
					if 	($row['password'] == $passwordLogin && $row['user_type'] == 0 ) {
						$user_id = $row['user_id'];
						$_SESSION['user_id']   = $row['user_id'];
						$_SESSION['user_type'] = $row['user_type'];
						$_SESSION['fname']     = $row['fname'];
						$_SESSION['lname']     = $row['lname'];

					/*	header("Location: ../adoption-list/adoption-list.controller.php?id=".$user_id);*/
						
						  ?> <meta http-equiv="refresh" content=".01;url=../user-profile/uprofile.controller.php?id=42"> <?php
						exit;
					}
					
					  if 	($row['password'] == $passwordLogin && $row['user_type'] == 1 ) {
						
					 ?> <meta http-equiv="refresh" content=".01;url=../user-profile/adminprofile.php"> <?php
						exit;
					}
				}
			}
		}
	}
}		
?>


<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<link rel="stylesheet" href="login.css">
	<link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
</head>
<body>
	<div class="topnav">
		<a href='../registration/register.php'>Sign Up</b>
		<a href="../index.php">Home</a>
	</div>
		<div class="bg-img">
			<FORM method="POST" action="login.php" class="login-container">
				<h1 class="no-margin">
					<span style='color: red; font-family: consolas; font-size: 12px;'>
						<?php
							if ($_POST['login']) {
							    if ($usernameLogin != "" && $passwordLogin !== "") {
									$sqlSelect = "SELECT * from tbl_users WHERE username='$usernameLogin'";
									$result = $conn->query($sqlSelect);
									if ($result->num_rows > 0) {
									  	$row = $result->fetch_assoc();
									   	if ($row['password'] != $passwordLogin) {
										    echo "Incorrect password and/or username.";
										} else if ($row['password'] == $passwordLogin && $row['status'] == "not active") {
									    		echo "Please check your email to activate your account.";
									    }
									} else {
										echo "No account yet. Please sign-up first.";
									}
								} else {
									echo "Please enter username and/or password.";
								}
							}
						?>
						</span> <br>
					<b>Welcome!</b><br><br>
					<label for="uName" class="login-text"><b>Username</b></label>
					<input type="text" placeholder="Enter Username" name="uName" value="<?php if ($_POST['login']) {echo $uName;} ?>">
					<label for="psw"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="psw">
					<input type="Submit" class="btn" name="login" value="Log In">
				</h1>
			</FORM>
		</div>


		<div class="clickhere-signup">
			<div class="clickhere">
				<p class="no-margin"><b>
					Not a member yet?
					<span>
						<a href='../registration/register.php' class="ibang-kulay">Click Sign-Up!</a>
					</span>

				</b></p>
			</div>
		</div>
	</body>
</html>
