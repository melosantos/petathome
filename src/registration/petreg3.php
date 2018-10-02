<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';
// ChromePhp::log('Hello console!');

//checking for login details page security
if($_SESSION['user_id'] == ""){
	echo "Your are not allowed here!!!";

	?>	
	 <script> alert("Please log in first"); </script>
	 <meta http-equiv="refresh" content="0;url=index.php"/>

	<?php
		header("location: index.php");
} 

$petname = $_POST['petname'];
$breed = $_POST['breed'];
$gender = $_POST['gender'];
$pet_type = $_POST['pet_type'];
$bday = $_POST['bday'];
$rdate = $_POST['rdate'];
$dsc = $_POST['dsc'];
$document_id = $_POST['document_id'];
$file_type = $_POST['file_type'];
$file_size = $_POST['file_size'];

//1
$user_id = $_SESSION['user_id'];
echo $user_id;
ChromePhp::log('USER ID:');
ChromePhp::log($_SESSION['user_id']);

$uploaddir = 'petpics/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if ($_POST['btnRegister']) {
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		ChromePhp::log($_FILES);
		
	} else {
		ChromePhp::log("Upload failed");
	}
    $conn = new mysqli($localhost, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	//persist to tbl_file(image)
	$strInsertFile = "INSERT INTO tbl_file(file_name, file_size)
	VALUES ('".$_FILES['userfile']['name']."', ".$_FILES['userfile']['size'].")";
	$conn->query($strInsertFile) or die($conn->error);
	$file_image_id = $conn->insert_id;

	//persist to tbl_file(docs)
	$strInsertDocsFile = "INSERT INTO tbl_document(document_type)
		VALUES ('.png')"; //doxx pdf
	$conn->query($strInsertDocsFile) or die($conn->error);
	$file_document_id = $conn->insert_id;


	if(isset($file_image_id) && isset($file_document_id)) {
		$strInsertPet = "INSERT INTO tbl_pets(petname, breed, gender, pet_type, bday, dsc, tbl_users_user_id, tbl_file_file_id)
		VALUES ('$petname', '$breed', '$gender', '$pet_type','$bday',  '$dsc', ".$user_id.", ".$file_image_id.")";
		$conn->query($strInsertPet) or die($strInsertPet);
		$pet_id = $conn->insert_id;

		if(isset($pet_id)) {
				//persist to tbl_docs using $file_docs_id and $pet_id
			$strInsertDocument = "INSERT INTO tbl_document(document_type, tbl_file_file_id, tbl_pets_pet_id)
			VALUES ('Birth Cert', '$file_document_id', '$pet_id')"; //doxx pdf
			$conn->query($strInsertDocsFile) or die($conn->error);

			//persist to tbl_docs using $file_docs_id and $pet_id
			$strInsertTransaction = "INSERT INTO tbl_adopt_transc(is_adopted, tbl_pets_pet_id)
				VALUES (0, ".$pet_id.")"; 
			$conn->query($strInsertTransaction) or die($strInsertTransaction);

			echo '<div class="member">';
			echo 'Congratulations, ' . $petname . '! You are one step closer to finding a new home.';
			echo '<a href="../adoption-list/adoption-list.php">See Pets for adoption!</a>';
			echo '</div>';
			$conn->close();
		}
	} else {
		ChromePhp::log("No file ID");
		ChromePhp::log($strInsertFile);

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
	<title>Pet Registration</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<link rel="stylesheet" href="register.css">
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
</head>
<body>
	<div class="topnav">
		<a href='../adoption-list/adoption-list.controller.php?id=<?php echo $user_id ?>'>Adoption List</a>
        <a href="../user-profile/uprofile.controller.php?id=<?php echo $user_id?>">My Profile</a>
	</div>
	<div class="signup-bg">
		<img src="../../img/petreg.png" class="petreg">
		<FORM enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="signup-container">
			<b>Tell us about your pet!</b><br>



			<label for="pet_type" class="signup-style"><b>Pet Type</b></label>
			<select name="pet_type" id="pet_type" class="signup-style" required value="<?php echo $_POST['pet_type']; ?>" ><br>
				<option value="Dog">Dog</option>
				<option value="Cat">Cat</option>

			</select>
			<br>


			<label for="pet_name" class="signup-style"><b>Pet Name</b></label>
			<input type="text" placeholder="Enter Pet Name" name="petname" required value="<?php echo $_POST['petname']; ?>">




			<label for="gender" class="signup-style"><b>Gender</b></label>
			<select name="gender" id="gender" class="signup-style" required value="<?php echo $_POST['gender']; ?>" ><br>
				<option value="F">Female</option>
				<option value="M">Male</option>

			</select>
			<br>


			<label for="breed" class="signup-style"><b>Breed</b></label>
			<input type="text" placeholder="Enter Breed" name="breed"  value="<?php echo $_POST['breed']; ?>">



			<label for="dsc" class="signup-style"><b>Markings</b></label>
			<input type="text" placeholder="Markings" name="dsc" required value="<?php echo $_POST['dsc']; ?>">

			<label for="bday" class="signup-style"><b>Birthday</b></label>
			<input type="date" placeholder="Birthday" name="bday"  class="signup-style" required value="<?php echo $_POST['bday']; ?>">
					<br>

<!----
	
	--->	
			
			<input type="hidden" name="MAX_FILE_SIZE" value="512000" />
			Choose image: <input name="userfile" type="file" />
			<input type="Submit" name="btnRegister" value="Register" class="btn">
				<br>	<br>

		</FORM>
	</div>




</body>
</html>