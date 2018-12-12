<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';

$user_data = $_SESSION['user_data'];
ChromePhp::log('USER data:');
ChromePhp::log($_SESSION['user_data']);
$user_id  = $_SESSION['user_id'];
$pet_data = $_SESSION['pet_data'];
ChromePhp::log('USER pets:');
ChromePhp::log($_SESSION['pet_data']);
$user_notifications = $_SESSION['user_notifications'];
ChromePhp::log('USER notifs:');
ChromePhp::log($_SESSION['user_notifications']);


$uname = $_POST['username'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$contactNo = $_POST['contactNo'];
$bday = $_POST['bday'];
$houseNo = $_POST['houseNo'];
$streetName = $_POST['streetName'];
$subdivision = $_POST['subdivision'];
$barangay = $_POST['barangay'];
$city = $_POST['city'];
$province = $_POST['province'];
$zipCode = $_POST['zipCode'];
$sendUpdateForm = $_POST['sendUpdateForm'];


if ($_POST['sendUpdateForm']){
$controllerKeme = <<<EOT
uprofile.controller.php?updateUser=true&username=$uname&fname=$fname&mname=$mname&lname=$lname&email=$email&contactNo=$contactNo&bday=$bday&houseNo=$houseNo&streetName=$streetName&subdivision=$subdivision&barangay=$barangay&city=$city&province=$province&zipCode=$zipCode&userId=$user_id
EOT;

header("location: ".$controllerKeme);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<link rel="stylesheet" type="text/css" href="uprofile.css">
	<link rel="stylesheet" type="text/css" href="uprofile.js">
	<link rel="stylesheet" type="text/css" href="modal.css">
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">

</head>
<body>
	<div class="topnav">
		<a href='../registration/petreg.php'>Donate Pets</b></a>
		<a href='../adoption-list/adoption-list.controller.php?id=<?php echo $user_id ?>'>Adoption List</a>
		<a href='../index.php?logout=1'>Log Out</b></a>

	</div>

	<div class="container">
		<div class="profile-section">
			<h1>MY PROFILE</h1>
			<div class="user-details">
				<div class="user-image">
					<img src="../registration/userpics/<?php echo $user_data['file_name'].'.'.$user_data['file_type']; ?>" alt="" width="100">
					<!-- <a href="#" class="adopt-button">CHANGE PICTURE</a> -->
				</div>
				<div class="edit">
					<button class="button button1" id="myBtn">Edit Profile</button></a>
				</div>
				<div class="user-info">
					<div class="user-name">
						<?php echo $user_data['username']; ?>
					</div>

					<div class="user-sub-details">
						<?php echo $user_data['fname']; ?>
						<?php echo $user_data['mname']; ?>
						<?php echo $user_data['lname']; ?><br>
						<?php echo $user_data['email']; ?><br>
						<?php echo $user_data['bday']; ?><br>
						<?php echo $user_data['contact_no']; ?><br>
						<?php echo $user_data['house_no']; ?>
						<?php echo $user_data['streetname']; ?>
						<?php echo $user_data['subd']; ?>
						<?php echo $user_data['brgy']; ?>
						<?php echo $user_data['city']; ?>
						<?php echo $user_data['province']; ?>
						<?php echo $user_data['zipcode']; ?>
					</div>
				</div>
			</div>
			<h1>MY PETS</h1>

			<div class="user-pets">

			<?php
if (isset($pet_data) || empty($pet_data)) {
    foreach ($pet_data as $key => $value) {
        echo '<div class="pet-card">';
        echo '<div class="pet-image">';
        echo '<img width="180" src="../registration/petpics/' . $value['file_name'] . '">';
        echo '</div>';
        echo '<div class="pet-content">';
        echo $value['petname'];
        echo '<p>' . $value['breed'] . '</p>';
        echo '<div class="spacer"></div>';
        echo '</div>';
        echo '</div>';
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
if (isset($user_notifications)) {
    foreach ($user_notifications as $key => $value) {
        echo '<div class="notif-card">';
        echo '<div class="notif-image">';
        echo '</div>';
        echo '<div class="notif-info">';
        echo '<div class="notif-name">';
        echo $value['fname'] . " wants to adopt " . $value['petname'];
        echo '</div>';
        echo '<div class="spacer">';
        echo '</div>';
        echo '<a href="uprofile.controller.php?notifId=' . $value['notif_id'] . '" class="adopt-button">REVIEW</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No notifications yet";
}

?>
		</div>
	</div>

	<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <img src="../../img/edit.gif" class ="pencil">
			<form method="POST">
				<b class="label">Username</b>
				<input type="text" name="username" value="<?php echo $user_data['username']; ?>">
				<b class="label">First Name</b>
				<input type="text" name="fname" class="form" value="<?php echo $user_data['fname']; ?>">
				<b class="label">Middle Name</b>
				<input type="text" name="mname" class="form" value="<?php echo $user_data['mname']; ?>">
				<b class="label">Last Name</b>
				<input type="text" name="lname" class="form" value="<?php echo $user_data['lname']; ?>">
				<b class="label">E-mail Address</b>
				<input type="text" name="email" class="form" value="<?php echo $user_data['email']; ?>">
				<b class="label">Contact Number</b>
				<input type="text" name="contactNo" class="form" value="<?php echo $user_data['contactNo']; ?>">
				<b class="label">Birthday</b><br>
				<input type="date" name="bday" 	class="form" value="<?php echo $user_data['bday']; ?>"><br><br>
				<b class="label">House Number</b>
				<input type="text" name="houseNo" class="form" value="<?php echo $user_data['house_no']; ?>">
				<b class="label">Street Name</b>
				<input type="text" name="streetName" class="form" value="<?php echo $user_data['streetname']; ?>">
				<b class="label">Subdivision</b>
				<input type="text" name="subdivision" class="form" value="<?php echo $user_data['subd']; ?>">
				<b class="label">Barangay</b>
				<input type="text" name="barangay" class="form" value="<?php echo $user_data['brgy']; ?>">
				<b class="label">City</b>
				<input type="text" name="city" class="form" value="<?php echo $user_data['city']; ?>">
				<b class="label">Province</b>
				<input type="text" name="province" class="form" value="<?php echo $user_data['province']; ?>">
				<b class="label">Zip Code</b>
				<input type="text" name="zipCode" class="form" value="<?php echo $user_data['zipcode']; ?>">
				<input type="submit" name="sendUpdateForm" class="button button1">
			</form>
  </div>

</div>

<script type="text/javascript" src="modal.js"></script>

</body>
</html>