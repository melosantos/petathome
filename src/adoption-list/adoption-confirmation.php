<?php
include 'adoption-list.service.php';
include '../../config/config.php';



if($_POST['createNotification']){
	$message = $_POST['message'];
	parse_str($_SERVER['QUERY_STRING'], $params);
	if(count($params)) {
		if($params['createNotif']) {
			
			$owner_id = $params['ownerId'];
			$interested_id = $params['interestId'];
			$transaction_id = $params['transactionId'];
		}

		//$message = $_POST['message'];
		?><script>//alert("<?php echo $message.' '.$owner_id.' '.$interested_id.' '.$transaction_id; ?>");</script><?php
		$conn = new mysqli($host, $username, $password, $db);
		// if ($conn->connect_error) {
		// 	die("Connection failed: " . $conn->connect_error);
		// }
		$sqlCreateNotification = "INSERT INTO tbl_notif(
									interest_reason,
									tbl_user_owner_user_id,
									tbl_user_interest_user_id,
									tbl_adopt_transc_transc_id
								) VALUES (
									'$message',
									'$owner_id',
									'$interested_id',
									'$transaction_id'
								)";
		mysqli_query($conn, $sqlCreateNotification);
		// $result = $conn->query($sqlCreateNotification) or die($sqlCreateNotification);
		header("Location: ../adoption-list/adoption-list.php");
		$conn->close();
	}
}

// if($_POST['createNotification']) {
// 	header( 'Location: adoption-list.controller.php?createNotif=true&ownerId='.$owner_id.'&interestId='.$interested_id.'&transactionId='.$transaction_id.'&message='.$message);
// }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
    <link rel="stylesheet" type="text/css" href="adoption-confirmation.css">
	<link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
</head>
<body>
	<div class="topnav">
		<a href='../registration/register.php'>Sign Up</b>
		<a href="../index.php">Home</a>
	</div>

	<div class="message-container">
		<div class="pet-information">

		</div>
		<div class="adoption-message-form" id="adoption-form">
			<?php
				echo 	'<form method="POST">';
				//echo	'<form action="adoption-list.controller.php?createNotif=true&ownerId='.$owner_id.'&interestId='.$interested_id.'&transactionId='.$transaction_id.'&message='.$message.'" method="post">';
				echo	'<textarea name="message" rows="10" cols="30">The cat was playing in the garden.</textarea>';
				echo	'<input type="submit" name="createNotification" value="SUBMIT">';
				echo	'</form>';
			?>
		</div>
	</div>
    <?php
    //insert message form here...
    ?>
	</body>
	</html>
