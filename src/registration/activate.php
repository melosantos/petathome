<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';
ChromePhp::log('Hello console!');


if($_GET['id']){
    $_SESSION['id'] = $_GET['id'];
	$activationcode = $_SESSION['id'];

	$conn = new mysqli($host, $username, $password, $db);
	if ($conn->connect_error) {
	   die("Connection failed: " . $conn->connect_error);
	}

	else if ($activationcode!="") {
		$strVerif="	UPDATE tbl_users 
	    	  		SET activationcode = '', status = 'active'
	               	WHERE activationcode = '$activationcode'
	               	";
        $conn->query($strVerif) or die ($strVerif);
        header('location: ../authentication/login.php');
    }
} 
else {
	echo "failed";
}

?>