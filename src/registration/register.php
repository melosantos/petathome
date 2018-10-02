	<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';
ChromePhp::log('Hello console!');

$uploaddir = 'userpics/';
$uploadfile = $uploaddir.$_FILES['userfile']['name'];
$path_parts = pathinfo($uploadfile);

$file_name = $path_parts['filename'];
$file_type = $path_parts['extension'];

$uName      = $_POST['uName'];
$psw        = $_POST['psw'];
$cpsw       = $_POST['cpsw'];
$email      = $_POST['email'];
$fName      = $_POST['fName'];
$mName      = $_POST['mName'];
$lName      = $_POST['lName'];
$bday       = $_POST['bday'];
$contact_no = $_POST['contact_no'];
$cities     = $_POST['cities'];
$server = $_SERVER['SERVER_NAME'];
$activationcode=md5($email.time());


if ($_POST['btnRegister']) {

	if (
	($uName!="" && $psw!="" && $cpsw!="") &&
	($email!="" && $fName!="" && $lName!="") &&
	($bday!="" && $contact_no!="") &&
	($cities!="" && $psw === $cpsw)
	) {
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			ChromePhp::log($_FILES);
		}
		else {
			ChromePhp::log("Upload failed");
		}
	}

	$conn = new mysqli($host, $username, $password, $db);
	if ($conn->connect_error) {
	   die("Connection failed: " . $conn->connect_error);
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
	<link rel="stylesheet" type="text/css" href="register.css">
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">

	<div class="topnav">
		<a href='../index.php'>Back to Home</a>
	</div>
	<div class="signup-bg">
		<img src="../../img/c3.png" class="sign-up-ming">
		<b class="form-title">PETS ARE WAITING FOR YOU! </b><br>
		<FORM enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  class="signup-container">
			
			<label for="uName" class="signup-style"><b>Username</b></label>	
			<table class="signup-table">
				<tr>
					<td> 
						<input type="text" placeholder="Enter Username" name="uName" value="<?php if ($_POST['btnRegister']) {echo $uName;} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php 
						if ($_POST['btnRegister']) {
							if ($uName == "") {
								echo "<p class='signup-error'> * Required field. </p>"; 
							}
							else if ($uName != "") {
								if (preg_match("/^[a-zA-Z0-9]{6,12}$/", $uName) === 0) {
									echo "<p class='signup-error'> * Minimum of 6 and maximum of 12 characters. Spaces and special characters are not allowed. </p>";
							    }
							    else if (preg_match("/^[a-zA-Z0-9]{6,12}$/", $uName) === 1) {

										$sqlSelect="SELECT * FROM tbl_users WHERE (username='$uName');";
										$result=$conn->query($sqlSelect);
										if ($result->num_rows > 0) {
											$row = $result->fetch_assoc();
											if ($uName==$row['username']) {
												echo "<p class='signup-error'> * Username already exists. </p>"; 
											}
										}
										else {
											echo "<p class='signup-check'> &#10004; </p>";
										}

							    }
							}
						}
						?> 	
					</td>
				</tr>
			</table>

			<label for="psw" class="signup-style"><b>Password</b></label>
			<table class="signup-table">
				<tr>
					<td> 
						<input type="password" placeholder="Enter Password" name="psw"  value="<?php if ($_POST['btnRegister']) {echo $psw;} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php
						if ($_POST['btnRegister']) {
							if ($psw == "") {
								echo "<p class='signup-error'> * Required field. </p>"; 
							}
							else if ($psw != "") {
								if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,12}/", $psw) === 0) {
									echo "<p class='signup-error'> * Minimum of 6 and maximum of 12 characters only. Must contain atleast one number, one lower case and one upper case letter. </p>";
								}
								else if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,12}/", $psw) === 1) {
									echo "<p class='signup-check'> &#10004; </p>";				
	 							}			
							}
						}
						?> 					
					</td>
				</tr>
			</table>

			<label for="cpsw" class="signup-style"><b>Confirm Password</b></label>

			<table class="signup-table"> 
				<tr>
					<td>
						<input type="password" placeholder="Confirm Password" name="cpsw">	
					</td>
					<td class="signup-validation"> 
						<?php
						if ($_POST['btnRegister']) {
							if ($cpsw == "") {
								echo "<p class='signup-error'> * Required field. </p>"; 
							}
							else if ($cpsw != "") {
								if ($cpsw !== $psw) {
									echo "<p class='signup-error'> * Password did not match. </p>";
								}
								else if ($cpsw === $psw) {
									echo "<p class='signup-check'> &#10004; </p>";
								} 
							}
						}
						?> 					
					</td>
				</tr>
			</table>

			<label for="email" class="signup-style"><b>Email Address</b></label>
			<table class="signup-table"> 
				<tr>
					<td>
						<input type="text" placeholder="Enter Email Address" name="email"  value="<?php if ($_POST['btnRegister']) {echo $email;} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php 
						if ($_POST['btnRegister']) {
							if ($email == "") {
								echo "<p class='signup-error'> * Required field. </p>"; 
							}
							else if ($email != "") {
								if (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/", $email) === 0) {
									echo "<p class='signup-error'> * Invalid E-mail Address. </p>";
							    }
							    else if (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/", $email) === 1)	{
									    	
									   	$sqlSelect="SELECT * FROM tbl_users WHERE (email='$email');";
										$result=$conn->query($sqlSelect);
										if ($result->num_rows > 0) {
											$row = $result->fetch_assoc();
											if ($email==$row['email']) {
												echo "<p class='signup-error'> * E-mail already exists. </p>";
											}
										}
										else {
											echo "<p class='signup-check'> &#10004; </p>";
										}
									
								
							    }   
							}
						}
						?>
					</td>
				</tr>
			</table>

			<label for="fName" class="signup-style"><b>First Name</b></label>
			<table class="signup-table"> 
				<tr>
					<td>
						<input type="text" placeholder="Enter First Name" name="fName"value="<?php if ($_POST['btnRegister']) {echo "$fName";} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php 
							if ($_POST['btnRegister']) {
								if ($fName == "") {
									echo "<p class='signup-error'> * Required field. </p>"; 
								}
								else if ($fName != "") {
									if (preg_match("/^[a-zA-Z -]{2,50}$/", $fName) === 0) {
										echo "<p class='signup-error'> * Maximum of 50 characters. Special characters and numbers are not allowed. </p>";
								    }
								    
								    else if (preg_match("/^[a-zA-Z -]{2,50}$/", $fName) === 1) {
								    	echo "<p class='signup-check'> &#10004; </p>";
								    }
								}
							}	
						?> 	
					</td>					
				</tr>
			</table>

			<label for="mName" class="signup-style"><b>Middle Name</b></label>
			<table class="signup-table"> 
				<tr>
					<td>
						<input type="text" placeholder="Enter Middle Name" name="mName" value="<?php if ($_POST['btnRegister']) {echo "$mName";} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php 
							if ($_POST['btnRegister']) {
								if ($mName == "") {
									// echo "<p class='signup-check'> </p>"; not required
								}
								else if ($mName != "") {
									if (preg_match("/^[a-zA-Z -]{1,50}$/", $mName) === 0) {
										echo "<p class='signup-error'> * Maximum of 50 characters. Special characters and numbers are not allowed. </p>";
								    }
								    
								    else if (preg_match("/^[a-zA-Z -]{1,50}$/", $mName) === 1) {
								    	echo "<p class='signup-check'> &#10004; </p>";
								    }
								}
							}	
						?> 	
					</td>	 
			</tr>
				</tr>
			</table>

			<label for="lName" class="signup-style"><b>Last Name</b></label>
			<table class="signup-table"> 
				<tr>
					<td>
						<input type="text" placeholder="Enter Last Name" name="lName" value="<?php if ($_POST['btnRegister']) {echo "$lName";} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php 
							if ($_POST['btnRegister']) {
								if ($lName == "") {
									echo "<p class='signup-error'> * Required field. </p>"; 
								}
								else if ($lName != "") {
									if (preg_match("/^[a-zA-Z -]{2,50}$/", $lName) === 0) {
										echo "<p class='signup-error'> * Maximum of 50 characters. Special characters and numbers are not allowed. </p>";
								    }
								    else if (preg_match("/^[a-zA-Z -]{2,50}$/", $lName) === 1) {
								    	echo "<p class='signup-check'> &#10004; </p>";
								    }
								}
							}	
						?> 	
				</td>
				</tr>
			</table>						

			<label for="bday" class="signup-style"><b>Birthday</b></label>
			<table class="signup-table"> 
				<tr>
					<td>
						<input type="date" placeholder="Enter Birthday" name="bday" value="<?php if ($_POST['btnRegister']) {echo "$bday";} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php 
							if ($_POST['btnRegister']) {
								if ($bday == "") {
									echo "<p class='signup-error'> * Required field. </p>"; 
								}
								else if ($bday != ""){
								    echo "<p class='signup-check'> &#10004; </p>";
								}
							}	
						?> 	
					</td>
				</tr>
			</table>	

			<label for="contact_no" class="signup-style"><b>Cellphone No.</b></label>
			<table class="signup-table"> 
				<tr>
					<td>
						<input type="text" placeholder="Enter Cellphone No." name="contact_no" value="<?php if ($_POST['btnRegister']) {echo "$contact_no";} ?>"> 
					</td>
					<td class="signup-validation"> 
						<?php 
							if ($_POST['btnRegister']) {
								if ($contact_no == "") {
									echo "<p class='signup-error'> * Required field. </p>"; 
								}
								else if ($contact_no != ""){
									if (preg_match("/^09\d{9}$/", $contact_no) === 0) {  // (09|\+639)\d{9}					
										echo "<p class='signup-error'> * Invalid number or format. </p>";
									}
									else if (preg_match("/^09\d{9}$/", $contact_no) === 1) {	
									   echo "<p class='signup-check'> &#10004; </p>";
									}
								}
							}	
						?> 	
					</td>
				</tr>
			</table>	

			<label for="city" class="signup-style"><b>City :</b></label>	
			<table class="signup-table"> 
				<tr>
					<td>
						<select name="cities" id="cities" class="signup-style">	
							<option value="" <?php if ($cities == "") {echo 'selected'; } ?>>---Select City ---</option>
							<option value="Caloocan" <?php if ($cities == "Caloocan") {echo 'selected'; } ?>>Caloocan</option>
							<option value="Las Piñas" <?php if ($cities == "Las Piñas") {echo 'selected'; } ?>>Las Piñas</option>
							<option value="Makati" <?php if ($cities == "Makati ") {echo 'selected'; } ?>>Makati </option>
							<option value="Malabon" <?php if ($cities == "Malabon") {echo 'selected'; } ?>>Malabon</option>
							<option value="Mandaluyong" <?php if ($cities == "Mandaluyong") {echo 'selected'; } ?>>Mandaluyong</option>
							<option value="Manila" <?php if ($cities == "Manila") {echo 'selected'; } ?>>Manila</option>
							<option value="Marikina" <?php if ($cities == "Marikina") {echo 'selected'; } ?>>Marikina</option>
							<option value="Muntinlupa" <?php if ($cities == "Muntinlupa") {echo 'selected'; } ?>>Muntinlupa</option>
							<option value="Navotas" <?php if ($cities == "Navotas") {echo 'selected'; } ?>>Navotas</option>
							<option value="Parañaque" <?php if ($cities == "Parañaque") {echo 'selected'; } ?>>Parañaque</option>
							<option value="Pasay" <?php if ($cities == "Pasay") {echo 'selected'; } ?>>Pasay</option>
							<option value="Pasig" <?php if ($cities == "Pasig ") {echo 'selected'; } ?>>Pasig </option>
							<option value="Quezon City" <?php if ($cities == "Quezon City") {echo 'selected'; } ?>>Quezon City</option>
							<option value="San Juan" <?php if ($cities == "San Juan") {echo 'selected'; } ?>>San Juan</option>
							<option value="Taguig" <?php if ($cities == "Taguig") {echo 'selected'; } ?>>Taguig</option>
							<option value="Valenzuela" <?php if ($cities == "Valenzuela") {echo 'selected'; } ?>>Valenzuela</option>
							<option value="Butuan" <?php if ($cities == "Butuan") {echo 'selected'; } ?>>Butuan</option>
							<option value="Cabadbaran" <?php if ($cities == "Cabadbaran") {echo 'selected'; } ?>>Cabadbaran</option>
							<option value="Bayugan" <?php if ($cities == "Bayugan") {echo 'selected'; } ?>>Bayugan</option>
							<option value="Legazpi" <?php if ($cities == "Legazpi") {echo 'selected'; } ?>>Legazpi</option>
							<option value="Ligao" <?php if ($cities == "Ligao") {echo 'selected'; } ?>>Ligao</option>
							<option value="Tabaco" <?php if ($cities == "Tabaco") {echo 'selected'; } ?>>Tabaco</option>
							<option value="Isabela" <?php if ($cities == "Isabela") {echo 'selected'; } ?>>Isabela</option>
							<option value="Lamitan" <?php if ($cities == "Lamitan") {echo 'selected'; } ?>>Lamitan</option>
							<option value="Balanga" <?php if ($cities == "Balanga") {echo 'selected'; } ?>>Balanga</option>
							<option value="Batangas City" <?php if ($cities == "Batangas City") {echo 'selected'; } ?>>Batangas City</option>
							<option value="Lipa" <?php if ($cities == "Lipa") {echo 'selected'; } ?>>Lipa</option>
							<option value="Tanauan" <?php if ($cities == "Tanauan") {echo 'selected'; } ?>>Tanauan</option>
							<option value="Baguio" <?php if ($cities == "Baguio") {echo 'selected'; } ?>>Baguio</option>
							<option value="Tagbilaran" <?php if ($cities == "Tagbilaran") {echo 'selected'; } ?>>Tagbilaran</option>
							<option value="Malaybalay" <?php if ($cities == "Malaybalay") {echo 'selected'; } ?>>Malaybalay</option>
							<option value="Valencia" <?php if ($cities == "Valencia") {echo 'selected'; } ?>>Valencia</option>
							<option value="Malolos" <?php if ($cities == "Malolos") {echo 'selected'; } ?>>Malolos</option>
							<option value="Meycauayan" <?php if ($cities == "Meycauayan") {echo 'selected'; } ?>>Meycauayan</option>
							<option value="San Jose del Monte" <?php if ($cities == "San Jose del Monte") {echo 'selected'; } ?>>San Jose del Monte</option>
							<option value="Tuguegarao" <?php if ($cities == "Tuguegarao") {echo 'selected'; } ?>>Tuguegarao</option>
							<option value="Iriga" <?php if ($cities == "Iriga") {echo 'selected'; } ?>>Iriga</option>
							<option value="Naga" <?php if ($cities == "Naga") {echo 'selected'; } ?>>Naga</option>
							<option value="Roxas" <?php if ($cities == "Roxas") {echo 'selected'; } ?>>Roxas</option>
							<option value="Bacoor" <?php if ($cities == "Bacoor") {echo 'selected'; } ?>>Bacoor</option>
							<option value="Cavite City" <?php if ($cities == "Cavite City") {echo 'selected'; } ?>>Cavite City</option>
							<option value="Dasmariñas" <?php if ($cities == "Dasmariñas") {echo 'selected'; } ?>>Dasmariñas</option>
							<option value="Imus" <?php if ($cities == "Imus") {echo 'selected'; } ?>>Imus</option>
							<option value="Tagaytay" <?php if ($cities == "Tagaytay") {echo 'selected'; } ?>>Tagaytay</option>
							<option value="Trece Martires" <?php if ($cities == "Trece Martires") {echo 'selected'; } ?>>Trece Martires</option>
							<option value="Bogo" <?php if ($cities == "Bogo") {echo 'selected'; } ?>>Bogo</option>
							<option value="Carcar" <?php if ($cities == "Carcar") {echo 'selected'; } ?>>Carcar</option>
							<option value="Cebu City" <?php if ($cities == "Cebu City") {echo 'selected'; } ?>>Cebu City</option>
							<option value="Danao" <?php if ($cities == "Danao") {echo 'selected'; } ?>>Danao</option>
							<option value="Lapu-Lapu" <?php if ($cities == "Lapu-Lapu") {echo 'selected'; } ?>>Lapu-Lapu</option>
							<option value="Mandaue" <?php if ($cities == "Mandaue") {echo 'selected'; } ?>>Mandaue</option>
							<option value="Naga" <?php if ($cities == "Naga") {echo 'selected'; } ?>>Naga</option>
							<option value="Talisay" <?php if ($cities == "Talisay") {echo 'selected'; } ?>>Talisay</option>
							<option value="Toledo" <?php if ($cities == "Toledo") {echo 'selected'; } ?>>Toledo</option>
							<option value="Kidapawan" <?php if ($cities == "Kidapawan") {echo 'selected'; } ?>>Kidapawan</option>
							<option value="Panabo" <?php if ($cities == "Panabo") {echo 'selected'; } ?>>Panabo</option>
							<option value="Samal" <?php if ($cities == "Samal") {echo 'selected'; } ?>>Samal</option>
							<option value="Tagum" <?php if ($cities == "Tagum") {echo 'selected'; } ?>>Tagum</option>
							<option value="Davao City" <?php if ($cities == "Davao City") {echo 'selected'; } ?>>Davao City</option>
							<option value="Digos" <?php if ($cities == "Digos") {echo 'selected'; } ?>>Digos</option>
							<option value="Mati" <?php if ($cities == "Mati") {echo 'selected'; } ?>>Mati</option>
							<option value="Borongan" <?php if ($cities == "Borongan") {echo 'selected'; } ?>>Borongan</option>
							<option value="Batac" <?php if ($cities == "Batac") {echo 'selected'; } ?>>Batac</option>
							<option value="Laoag" <?php if ($cities == "Laoag") {echo 'selected'; } ?>>Laoag</option>
							<option value="Candon" <?php if ($cities == "Candon") {echo 'selected'; } ?>>Candon</option>
							<option value="Vigan" <?php if ($cities == "Vigan") {echo 'selected'; } ?>>Vigan</option>
							<option value="Iloilo City" <?php if ($cities == "Iloilo City") {echo 'selected'; } ?>>Iloilo City</option>
							<option value="Passi" <?php if ($cities == "Passi") {echo 'selected'; } ?>>Passi</option>
							<option value="Cauayan" <?php if ($cities == "Cauayan") {echo 'selected'; } ?>>Cauayan</option>
							<option value="Ilagan" <?php if ($cities == "Ilagan") {echo 'selected'; } ?>>Ilagan</option>
							<option value="Santiago" <?php if ($cities == "Santiago") {echo 'selected'; } ?>>Santiago</option>
							<option value="Tabuk" <?php if ($cities == "Tabuk") {echo 'selected'; } ?>>Tabuk</option>
							<option value="San Fernando" <?php if ($cities == "San Fernando") {echo 'selected'; } ?>>San Fernando</option>
							<option value="Biñan" <?php if ($cities == "Biñan") {echo 'selected'; } ?>>Biñan</option>
							<option value="Cabuyao" <?php if ($cities == "Cabuyao") {echo 'selected'; } ?>>Cabuyao</option>
							<option value="Calamba" <?php if ($cities == "Calamba") {echo 'selected'; } ?>>Calamba</option>
							<option value="San Pablo" <?php if ($cities == "San Pablo") {echo 'selected'; } ?>>San Pablo</option>
							<option value="Santa Rosa" <?php if ($cities == "Santa Rosa") {echo 'selected'; } ?>>Santa Rosa</option>
							<option value="San Pedro" <?php if ($cities == "San Pedro") {echo 'selected'; } ?>>San Pedro</option>
							<option value="Iligan" <?php if ($cities == "Iligan") {echo 'selected'; } ?>>Iligan</option>
							<option value="Marawi" <?php if ($cities == "Marawi") {echo 'selected'; } ?>>Marawi</option>
							<option value="Baybay" <?php if ($cities == "Baybay") {echo 'selected'; } ?>>Baybay</option>
							<option value="Ormoc" <?php if ($cities == "Ormoc") {echo 'selected'; } ?>>Ormoc</option>
							<option value="Tacloban" <?php if ($cities == "Tacloban") {echo 'selected'; } ?>>Tacloban</option>
							<option value="Cotabato City" <?php if ($cities == "Cotabato City") {echo 'selected'; } ?>>Cotabato City</option>
							<option value="Masbate City" <?php if ($cities == "Masbate City") {echo 'selected'; } ?>>Masbate City</option>
							<option value="Oroquieta" <?php if ($cities == "Oroquieta") {echo 'selected'; } ?>>Oroquieta</option>
							<option value="Ozamiz" <?php if ($cities == "Ozamiz") {echo 'selected'; } ?>>Ozamiz</option>
							<option value="Tangub" <?php if ($cities == "Tangub") {echo 'selected'; } ?>>Tangub</option>
							<option value="Cagayan de Oro" <?php if ($cities == "Cagayan de Oro") {echo 'selected'; } ?>>Cagayan de Oro</option>
							<option value="El Salvador" <?php if ($cities == "El Salvador") {echo 'selected'; } ?>>El Salvador</option>
							<option value="Gingoog" <?php if ($cities == "Gingoog") {echo 'selected'; } ?>>Gingoog</option>
							<option value="Bacolod" <?php if ($cities == "Bacolod") {echo 'selected'; } ?>>Bacolod</option>
							<option value="Bago" <?php if ($cities == "Bago") {echo 'selected'; } ?>>Bago</option>
							<option value="Cadiz" <?php if ($cities == "Cadiz") {echo 'selected'; } ?>>Cadiz</option>
							<option value="Escalante" <?php if ($cities == "Escalante") {echo 'selected'; } ?>>Escalante</option>
							<option value="Himamaylan" <?php if ($cities == "Himamaylan") {echo 'selected'; } ?>>Himamaylan</option>
							<option value="Kabankalan" <?php if ($cities == "Kabankalan") {echo 'selected'; } ?>>Kabankalan</option>
							<option value="La Carlota" <?php if ($cities == "La Carlota") {echo 'selected'; } ?>>La Carlota</option>
							<option value="Sagay" <?php if ($cities == "Sagay") {echo 'selected'; } ?>>Sagay</option>
							<option value="San Carlos" <?php if ($cities == "San Carlos") {echo 'selected'; } ?>>San Carlos</option>
							<option value="Silay" <?php if ($cities == "Silay") {echo 'selected'; } ?>>Silay</option>
							<option value="Sipalay" <?php if ($cities == "Sipalay") {echo 'selected'; } ?>>Sipalay</option>
							<option value="Talisay" <?php if ($cities == "Talisay") {echo 'selected'; } ?>>Talisay</option>
							<option value="Victorias" <?php if ($cities == "Victorias") {echo 'selected'; } ?>>Victorias</option>
							<option value="Bais" <?php if ($cities == "Bais") {echo 'selected'; } ?>>Bais</option>
							<option value="Bayawan" <?php if ($cities == "Bayawan") {echo 'selected'; } ?>>Bayawan</option>
							<option value="Canlaon" <?php if ($cities == "Canlaon") {echo 'selected'; } ?>>Canlaon</option>
							<option value="Dumaguete" <?php if ($cities == "Dumaguete") {echo 'selected'; } ?>>Dumaguete</option>
							<option value="Guihulngan" <?php if ($cities == "Guihulngan") {echo 'selected'; } ?>>Guihulngan</option>
							<option value="Tanjay" <?php if ($cities == "Tanjay") {echo 'selected'; } ?>>Tanjay</option>
							<option value="Cabanatuan" <?php if ($cities == "Cabanatuan") {echo 'selected'; } ?>>Cabanatuan</option>
							<option value="Gapan" <?php if ($cities == "Gapan") {echo 'selected'; } ?>>Gapan</option>
							<option value="Muñoz" <?php if ($cities == "Muñoz") {echo 'selected'; } ?>>Muñoz</option>
							<option value="Palayan" <?php if ($cities == "Palayan") {echo 'selected'; } ?>>Palayan</option>
							<option value="San Jose" <?php if ($cities == "San Jose") {echo 'selected'; } ?>>San Jose</option>
							<option value="Puerto Princesa" <?php if ($cities == "Puerto Princesa") {echo 'selected'; } ?>>Puerto Princesa</option>
							<option value="Angeles" <?php if ($cities == "Angeles") {echo 'selected'; } ?>>Angeles</option>
							<option value="Mabalacat" <?php if ($cities == "Mabalacat ") {echo 'selected'; } ?>>Mabalacat </option>
							<option value="San Fernando" <?php if ($cities == "San Fernando") {echo 'selected'; } ?>>San Fernando</option>
							<option value="Alaminos" <?php if ($cities == "Alaminos") {echo 'selected'; } ?>>Alaminos</option>
							<option value="Dagupan" <?php if ($cities == "Dagupan") {echo 'selected'; } ?>>Dagupan</option>
							<option value="San Carlos" <?php if ($cities == "San Carlos") {echo 'selected'; } ?>>San Carlos</option>
							<option value="Urdaneta" <?php if ($cities == "Urdaneta") {echo 'selected'; } ?>>Urdaneta</option>
							<option value="Lucena" <?php if ($cities == "Lucena") {echo 'selected'; } ?>>Lucena</option>
							<option value="Tayabas" <?php if ($cities == "Tayabas") {echo 'selected'; } ?>>Tayabas</option>
							<option value="Antipolo" <?php if ($cities == "Antipolo") {echo 'selected'; } ?>>Antipolo</option>
							<option value="Calbayog" <?php if ($cities == "Calbayog") {echo 'selected'; } ?>>Calbayog</option>
							<option value="Catbalogan" <?php if ($cities == "Catbalogan") {echo 'selected'; } ?>>Catbalogan</option>
							<option value="Sorsogon City" <?php if ($cities == "Sorsogon City") {echo 'selected'; } ?>>Sorsogon City</option>
							<option value="General Santos" <?php if ($cities == "General Santos") {echo 'selected'; } ?>>General Santos</option>
							<option value="Koronadal" <?php if ($cities == "Koronadal") {echo 'selected'; } ?>>Koronadal</option>
							<option value="Maasin" <?php if ($cities == "Maasin") {echo 'selected'; } ?>>Maasin</option>
							<option value="Tacurong" <?php if ($cities == "Tacurong") {echo 'selected'; } ?>>Tacurong</option>
							<option value="Surigao City" <?php if ($cities == "Surigao City") {echo 'selected'; } ?>>Surigao City</option>
							<option value="Bislig" <?php if ($cities == "Bislig") {echo 'selected'; } ?>>Bislig</option>
							<option value="Tandag" <?php if ($cities == "Tandag") {echo 'selected'; } ?>>Tandag</option>
							<option value="Tarlac City" <?php if ($cities == "Tarlac City") {echo 'selected'; } ?>>Tarlac City</option>
							<option value="Olongapo" <?php if ($cities == "Olongapo") {echo 'selected'; } ?>>Olongapo</option>
							<option value="Dapitan" <?php if ($cities == "Dapitan") {echo 'selected'; } ?>>Dapitan</option>
							<option value="Dipolog" <?php if ($cities == "Dipolog") {echo 'selected'; } ?>>Dipolog</option>
							<option value="Pagadian" <?php if ($cities == "Pagadian") {echo 'selected'; } ?>>Pagadian</option>
							<option value="Zamboanga City" <?php if ($cities == "Zamboanga City") {echo 'selected'; } ?>>Zamboanga City</option>
						</select>
					</td>
					<td class="signup-validation"> 
						<?php 
							if ($_POST['btnRegister']) {
								if ($cities == "") {
									echo "<p class='signup-error'> * Required field. </p>"; 
								}
								else if ($cities != "") {
								    echo "<p class='signup-check'> &#10004; </p>";
								}
							}	
						?> 	
					</td>
				</tr>
			</table>	
			
			<label for="city" class="signup-style"><b>Choose image:</b></label>	
				
			<table class="signup-table">
				<tr>
					<td>
						<input name="userfile" type="file" /> 
					</td>
					<td class="signup-validation"> 
						<?php 
							if ($_POST['btnRegister']) {
								if ($file_name == "") {
									echo "<p class='signup-error'> * Required field. </p>"; 
								}
								else if ($file_name != ""){
									if (
										$file_type != "jpg" && 
										$file_type != "png" && 
										$file_type != "jpeg" && 
										$file_type != "gif" 
										) {
								    	echo "<p class='signup-error'> * Invalid.  JPG, JPEG, PNG & GIF files are allowed.";
								    }
									else { 
								    	echo "<p class='signup-check'> &#10004; </p>";
									}
								}
							}	
						?> 	
					</td>
				</tr>
				<tr>
					<td> <input type="Submit" name="btnRegister" value="Register" class="btn"> </td>
				</tr>
			</table>
		</FORM>
		<br>
		<br>
	</div>
</html>

<?php
if ($_POST['btnRegister']) {
	if (
		($uName!="" && $psw!="" && $cpsw!="") &&
		($email!="" && $fName!="" && $lName!="") &&
		($bday!="" && $contact_no!="") &&
		($cities!="" && $psw === $cpsw && $file_type!="")
		) {

		if  (
			(preg_match("/^[a-zA-Z0-9]{6,12}$/", $uName) === 1) &&
			(preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/", $email) === 1) 
			) {

			$conn = new mysqli($host, $username, $password, $db);
			if ($conn->connect_error) {
			   die("Connection failed: " . $conn->connect_error);
			}
					
			else {
				$sqlSelect="SELECT * FROM tbl_users WHERE (username='$uName' OR email='$email')";
				$result=$conn->query($sqlSelect);			
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					echo '<div class="member">';
					echo 'May kaparehong username or email.';
					echo '</div>';
				} // if email and username does not exit 0

				else {
					if 	( 
						(preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,12}/", $psw) === 1) && 
					 	(preg_match("/^[a-zA-Z -]{2,50}$/", $fName) === 1) &&
					 	(preg_match("/^[a-zA-Z -]{1,50}$/", $lName) === 1) &&
					 	(preg_match("/^09\d{9}$/", $contact_no) === 1) 
					 	) {
										
						$strInsertAddress = "INSERT INTO tbl_address(city)
											VALUES ('$cities')";
						$conn->query($strInsertAddress) or die($strInsertAddress);
						$address_id = $conn->insert_id;	

						$strInsertFile = "INSERT INTO tbl_file(file_name,file_type,file_size)
										VALUES (
													'$file_name', 
													'$file_type',
													'".$_FILES['userfile']['size']."'
													)
													";
						$conn->query($strInsertFile) or die($strInsertFile);
						$file_id = $conn->insert_id;

						$strInsertUser = "INSERT INTO tbl_users(username,password,email,fname, mname, lname, bday, contact_no, tbl_address_address_id, tbl_file_file_id, activationcode)
										VALUES ('$uName','$psw','$email','$fName','$mName','$lName', '$bday', '$contact_no', '$address_id', '$file_id','$activationcode')";
						$conn->query($strInsertUser) or die($strInsertUser);
						$user_id = $conn->insert_id;
                            
					    echo "<script>alert('Registration successful, please verify in the registered Email address');</script>";
						echo "<script>window.location = '../authentication/login.php';</script>";

						//---Send e-mail verification to user---//
						if ($strInsertUser) {
							$to = $email;
							$subject = 'Welcome to Pet @ Home.ml';
							$message = "<!DOCTYPE html>
                                <html lang='en'>
                                <head>
                                    <meta charset='UTF-8'>
                                    <title></title>
                                    <style>
                                        h1 {
                                            background-color: #996633;
                                            color: white;
                                            font-family: tahoma;
                                        }

                                        .hello {
                                            color: teal;
                                            font-family: tahoma;
                                        }

                                        h4 {
                                            color: #996633;
                                            font-family: tahoma;
                                        }

                                        body {
                                            font-family: tahoma;
                                        }
                                 
                                        .header {
                                            border-bottom: 2px solid #996633;
                                            background-color: #fff;
                                            text-align: center;
                                            font-family: tahoma;
                                        }
                                 
                                        .footer {
                                            border-top: 2px solid #fa8072;
                                        }
                                 
                                        .footer {
                                            color: gray;
                                            font-family: tahoma;
                                            font-size: 12px;
                                        }
                                 
                                    </style>
                                </head>
                                <body>
                                <table width='100%'>
                                    <tr>
                                        <td align='center'>
                                            <table width='600'>
                                                <tr>
                                                    <td class='header'>
                                                        <h1>Pet @ Home</h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2>Verify Your Email Address</h2>
                                                        <h4 class='hello'> Hello $fName, </h4>
                                                        <p> Thanks for getting started with Pet @ Home! <br><br>
                                                            We need a little more information to complete your registration, including confirmation of your email address. <br><br>
                                                        Please follow the link below to verify your email address: <br>
                                                        <a href='$server/src/registration/activate.php?id=$activationcode'> Click here. </a> <br><br> Once done, you can log into your account with this username and password:<br> Username: $uName <br> Password: $psw </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <br><br/>
                                                        Regards,<br/>
                                                        <h4 class='team'>The Pet @ Home Team</h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='footer'>
                                                        Kvinde Software Development Company © All Rights Reserved 2018
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                </body>
                                </html>";

							$headers[] = 'Content-type: text/html; ; charset=utf-8';
							$headers[] = 'From: Pet @ Home Team <No-Reply@PetAtHome.ml>';
							mail($to, $subject, $message, implode("\r\n", $headers));
						} 
					}
				}
				$conn->close();	
			} // if sql connectected 	
		}
	}
	else {
		echo "<script>alert('Registration not successful. Please complete the required field/s properly.');</script>";
	}
} 

?>