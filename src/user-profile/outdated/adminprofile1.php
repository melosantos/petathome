<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';

$user_data = $_SESSION['user_data'];
ChromePhp::log('USER data:');
ChromePhp::log($_SESSION['user_data']);
$user_id = $_SESSION['user_id'];
$pet_data = $_SESSION['pet_data'];
ChromePhp::log('USER pets:');
ChromePhp::log($_SESSION['pet_data']);
$user_notifications = $_SESSION['user_notifications'];
ChromePhp::log('USER notifs:');
ChromePhp::log($_SESSION['user_notifications']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<link rel="stylesheet" type="text/css" href="uprofile.css">
	<link rel="stylesheet" type="text/css" href="uprofile.js">
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
</head>
<body>
	<div class="topnav">
		<a href='../registration/petreg.php'>Donate Pets</b></a>
		<a href='../adoption-list/adoption-list.controller.php?id=<?php echo $user_id ?>'>Adoption List</a>
		<a href='../admin/administrator.php?id=<?php echo $user_id ?>'>Admin Panel</a>
		<a href='../index.php'>Log Out</b></a>

	</div>

	<div class="container">
		<div class="profile-section">
			<h1>MY PROFILE</h1>
			<div class="user-details">
				<div class="user-image">
					<img src="../registration/userpics/<?php echo $user_data['file_name'] ?>" alt="" width="100">
					<!-- <a href="#" class="adopt-button">CHANGE PICTURE</a> -->
				</div>

				<div class="user-info">
					<div class="user-name">
						<?php echo $user_data['username'];?>
					</div>

					<div class="user-sub-details">
						<?php echo $user_data['fname'];?>
						<?php echo $user_data['lname'];?><br>
						<?php echo $user_data['email'];?>
					</div>
					
					<div class="user-sub-details">
						<?php echo $user_data['city'];?>
					</div>
				</div>
			</div>
			<h1>MY PETS</h1>

			<div class="user-pets">

			<?php
			if(isset($pet_data) || empty($pet_data)) {
				foreach ($pet_data as $key => $value) {
				echo	'<div class="pet-card">';
				echo		'<div class="pet-image">';
				echo               '<img width="180" src="../registration/petpics/'.$value['file_name'].'">';
				echo		'</div>';
				echo		'<div class="pet-content">';
				echo			$value['petname'];
				echo			'<p>'.$value['breed'].'</p>';
				echo			'<div class="spacer"></div>';
				echo		'</div>';
				echo 	'</div>';
				}
			} else {
				echo "No Pets to show";
			}
			?>
			</div>
		</div>

		<div class="notification-section">
			<h1>NOTIFICATION</h1>

			<?php 
			if(isset($user_notifications)) {
				foreach ($user_notifications as $key => $value) {
					echo	'<div class="notif-card">';
					echo		'<div class="notif-image">';
					echo		'</div>';
					echo		'<div class="notif-info">';
					echo			'<div class="notif-name">';
					echo				$value['fname']." wants to adopt ".$value['petname'];
					echo			'</div>';
					echo			'<div class="spacer">';
					echo			'</div>';
					echo			'<a href="uprofile.controller.php?notifId='.$value['notif_id'].'" class="adopt-button">REVIEW</a>';
					echo		'</div>';
					echo	'</div>';
				}
			} else {
				echo "No notifications yet";
			}

			?>

		</div>
	</div>
</body>
</html>