<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';
ChromePhp::log('Hello console!');


$fname      = $_POST['fname'];
$lname        = $_POST['lname'];
$email      = $_POST['email'];
$num       = $_POST['num'];
$comments      = $_POST['comments'];

if ($_POST['btnSubmit']) {

		
			
			
			if(isset($_POST['email'])) {
			 
				// EDIT THE 2 LINES BELOW AS REQUIRED
				$email_to = "kvindesdc@gmail.com";
				$email_subject = "I need your help!";
			 
				function died($error) {
					// your error code can go here
					echo "We are very sorry, but there were error(s) found with the form you submitted. ";
					echo "These errors appear below.<br /><br />";
					echo $error."<br /><br />";
					echo "Please go back and fix these errors.<br /><br />";
					die();
				}
			 
			 
				// validation expected data exists
				if(!isset($_POST['fname']) ||
					!isset($_POST['lname']) ||
					!isset($_POST['email']) ||
					!isset($_POST['num']) ||
					!isset($_POST['comments'])) {
					died('We are sorry, but there appears to be a problem with the form you submitted.');       
				}
			 
				 
			 
				$fname = $_POST['fname']; // required
				$lname = $_POST['lname']; // required
				$email_from = $_POST['email']; // required
				$num = $_POST['num']; // not required
				$comments = $_POST['comments']; // required
			 
				$error_message = "";
				$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
			 
			  if(!preg_match($email_exp,$email_from)) {
				$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
			  }
			 
				$string_exp = "/^[A-Za-z .'-]+$/";
			 
			  if(!preg_match($string_exp,$fname)) {
				$error_message .= 'The First Name you entered does not appear to be valid.<br />';
			  }
			 
			  if(!preg_match($string_exp,$lname)) {
				$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
			  }
			 
			  if(strlen($comments) < 2) {
				$error_message .= 'The Comments you entered do not appear to be valid.<br />';
			  }
			 
			  if(strlen($error_message) > 0) {
				died($error_message);
			  }
			 
				$email_message = "Hi, Kvinde! This human needs your help. Please see message below:\n\n";
			 
				 
				function clean_string($string) {
				  $bad = array("content-type","bcc:","to:","cc:","href");
				  return str_replace($bad,"",$string);
				}
			 
				 
			 
				$email_message .= "First Name: ".clean_string($fname)."\n";
				$email_message .= "Last Name: ".clean_string($lname)."\n";
				$email_message .= "Email: ".clean_string($email_from)."\n";
				$email_message .= "num: ".clean_string($num)."\n\n";
				$email_message .= "Comments: \n\n".clean_string($comments)."\n";
			 
			// create email headers
			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			@mail($email_to, $email_subject, $email_message, $headers);  
		
			 
			echo '<div class="member">';
			echo 'Thanks, ' . $fname . '! You will hear from us shortly.';
			echo '</div>';

		
			
			}

		}




function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<link rel="stylesheet" href="register.css">
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
</head>
<body>
	<div class="topnav">
		<a href='../index.php'>Back to Home</a>
	</div>
	<div class="signup-bg">
		<img src="../../img/c3.png" class="sign-up-ming">
		<b class="form-title">How can we help?</b><br>
		<FORM enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="signup-container">


			
			<label for="fname" class="signup-style"><b>First Name</b></label>
			<input type="text" placeholder="First Name" name="fname" required>


			<label for="lname" class="signup-style"><b>Last Name</b></label>
			<input type="text" placeholder="Last Name" name="lname" required>

	
			<label for="email" class="signup-style"><b>Email Address</b></label>
			<input type="text" placeholder="Enter Email Address" name="email" >

			<label for="num" class="signup-style"><b>Contact No.</b></label>
			<input type="text" placeholder="Contact No." name="num" pattern="(09|\+639)\d{9}" required>
			

		<label for="comments" class="signup-style"><b>Message</b></label><br>
			 <textarea  placeholder="Drop us a message!" class="signup-style" name="comments" maxlength="1000" cols="65" rows="12"><?php echo $var = isset($_POST['comments']) ? $_POST['comments'] : ''; ?></textarea>


			
<input type="Submit" name="btnSubmit" value="Submit" class="btn">
</FORM>
		
		

			
					
	