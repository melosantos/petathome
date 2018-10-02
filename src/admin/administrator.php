<?php
	include'../../config/config.php'; //for edit of filepath
	include 'adminfunc.php';



?>

<?php
        //delete a user account 
        if (isset($_GET['del'])) {

            $user_id = $_GET['del'];
            
            $db = mysqli_connect('localhost', 'root', '', 'id7163051_petathomedb');
            

            mysqli_query($db, "DELETE FROM tbl_users WHERE user_id=$user_id");
            
            //header('location: view_users.php');
            $_SESSION['message'] = "Account deleted!"; 

            ?>
            <meta http-equiv="refresh" content="5;url=administrator.php"/>
            <?php
        }

            //edit user account
        if (isset($_POST['btnupdate'])) {

            $user_id    = $_POST['user_id'];
            $uName      = $_POST['uName'];
            $user_type  = $_POST['user_type'];
            $status     = $_POST['status'];
            $psw        = $_POST['psw'];
            $cpsw       = $_POST['cpsw'];
            $email      = $_POST['email'];
            $fName      = $_POST['fName'];
            $mName      = $_POST['mName'];
            $lName      = $_POST['lName'];
            $bday       = $_POST['bday'];
            $contact_no = $_POST['contact_no'];
            $houseNo    = $_POST['houseNo'];
            $stName     = $_POST['stName'];
            $subd       = $_POST['subd'];
            $brgy       = $_POST['brgy'];
            $cities     = $_POST['cities'];
            $provinces  = $_POST['provinces'];
            $zip        = $_POST['zip'];
            
            $db = mysqli_connect('localhost', 'root', '', 'id7163051_petathomedb');
            $strquery = "UPDATE tbl_users SET username='$uName', password='$psw', 
                                email='$email', fname='$fName', mname='$mName', lname='$lName', bday='$bday' 
                                WHERE user_id=$user_id";
            mysqli_query($db, $strquery);

            $_SESSION['message'] = "Account updated!"; 
            
            //header('location: view_users.php');
        }


        /*added to check if it will work; put the old values in the form so that they can be modified */

        if (isset($_GET['edit'])) {
            $user_id = $_GET['edit'];
            $update = true;
            $record = mysqli_query($db, "SELECT * FROM tbl_users WHERE user_id=$user_id");

            if (count($record) == 1 ) {
                $row = mysqli_fetch_array($record);
                $uName = $row["username"];
                $psw =   $row["password"];
                $email = $row["email"];
                $fName = $row["fname"];
                $mName = $row["mname"];
                $lName = $row["lname"];
                $bday  = $row["bday"];
                $contact_no = $row["contact_no"];
                $houseNo = $row["house_no"];
                $stName = $row["streetname"];
                $subd = $row["subd"];
                $brgy = $row["brgy"];
                $cities = $row["city"];
                $provinces = $row["province"];
                $zip = $row["zip"];
            }
        }

        //add new user
        if (isset($_POST['btnsave'])) {
            $user_id    = $_POST['user_id'];
            $uName      = $_POST['uName'];
            $psw        = $_POST['psw'];
            $cpsw       = $_POST['cpsw'];
            $email      = $_POST['email'];
            $fName      = $_POST['fName'];
            $mName      = $_POST['mName'];
            $lName      = $_POST['lName'];
            $bday       = $_POST['bday'];
            $contact_no = $_POST['contact_no'];
            $houseNo    = $_POST['houseNo'];
            $stName     = $_POST['stName'];
            $subd       = $_POST['subd'];
            $brgy       = $_POST['brgy'];
            $cities     = $_POST['cities'];
            $provinces  = $_POST['provinces'];
            $zip        = $_POST['zip'];

            $notMatch = "Password didn't match";

            
            if ($psw != $cpsw) {
            echo '<div class="pw-notmatch">' . $notMatch . '</div>';
            } else {
                $db = mysqli_connect('localhost', 'id7163051_petathomedb', 'petathomedb', 'id7163051_petathomedb');
            $conn = new mysqli('localhost', 'id7163051_petathomedb', 'petathomedb', 'id7163051_petathomedb');
            
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                //Persist Address to DB
                $strInsertAddress = "INSERT INTO tbl_address(house_no, streetname, subd, brgy, city, province, zipcode)
                VALUES ('$houseNo', '$stName', '$subd', '$brgy', '$cities', '$provinces', '$zip')";
                $conn->query($strInsertAddress) or die($conn->error);
                $address_id = $conn->insert_id;

                //Persist File to DB
                $strInsertFile = "INSERT INTO tbl_file(file_type, file_size)
                VALUES ('n/a', 200)";
                $conn->query($strInsertFile) or die($conn->error);
                $file_id = $conn->insert_id;

                if ($address_id && $file_id) {
                    //Persist User
                    $strInsertUser = "INSERT INTO tbl_users(username, password ,email, fname, mname, lname, bday, contact_no, tbl_address_address_id, tbl_file_file_id)
                    VALUES ('$uName','$psw','$email','$fName','$mName','$lName', '$bday', '$contact_no', '$address_id', '$file_id')";

                    $conn->query($strInsertUser) or die($conn->error);

                    $_SESSION['message'] = "Address saved"; 

        
                    ?>
                    <meta http-equiv="refresh" content="5;url=administrator.php"/>
                    <?php
                } else {
                    echo "no address id created or file id!";
                }

                $conn->close();
            }
        } 

    }
?>


<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="adminstyle.css">
		

	<body>
		<div class="topnav">   

			<div class="search-container">
				<form method="POST">
					<input type="text" placeholder="Search.." name="txtsearch" class="search-container">
					<input type="submit" value="Go" class="topnav-search-container-button">

				</form>	

			</div>	
		</div>	
		<div class="adminpanel">
			<?php
				echo "Welcome, " . $_SESSION['fname'] . " " . $_SESSION['lname']."" ."!" ;
			?>		 
		</div>

			<!--<div class="manage">
			<a href="view_users.php" class="no_underline"><input type="submit" value="User Profiles" class="btn"></a>
				<a href="view_pets.php" class="no_underline"><input type="submit" value="Pet Profiles" class="btn"></a>
		</div> 	-->

		<div class="container_main_admin">
				
			<?php	
				//connect to database
			$conn = new mysqli('localhost', 'root', '', 'id7163051_petathomedb');
			if ($conn->connect_error) { 
				die("Connection failed: " . $conn->connect_error);
			} 

			
			//search bar
			$txtSearch = $_POST['txtsearch'];

			if(!empty($txtSearch)) {
				$sqlSelect = "SELECT * from tbl_users
				WHERE Email LIKE '%$txtSearch%' OR Username LIKE '%$txtSearch%'";
				$result = $conn->query($sqlSelect);
			?>

				<table>
					<thead>
						<tr>
							<th>Username</th>
							<th>User Type</th>
							<th>Status</th>
							<th>Password</th>
							<th>Email</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Birthday</th>
							<th>Mobile Number</th>
						</tr>     	
					</thead>

				<?php
				if ($result->num_rows > 0) {
					echo '<div class="dbstyle">';

					while($row = $result->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['user_type']; ?></td>
							<td><?php echo $row['status']; ?></td>
							<td><?php echo $row['password']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['fname']; ?></td>
							<td><?php echo $row['lname']; ?></td>
							<td><?php echo $row['bday']; ?></td>
							<td><?php echo $row['contact_no']; ?></td>
							<td>
								<a href="administrator.php?edit=<?php echo $row['user_id']; ?>" class="edit_btn" >Edit</a>
							</td>
							<td>
								<a href="administrator.php?del=<?php echo $row['user_id']; ?>" class="del_btn"> Delete</a>
							</td>
						</tr>
					<?php } ?>     
				</table>
				<br>		
			<?php
				echo '</div>';
						echo "<br>";
					} else {
						echo "No results found";
					}
					$conn->close();
				} 
			?>
		</div>


		<div>
			  <!--  displays a confirmation message to tell the user that a new record has been created in the database  -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif ?>

           <!-- <div class="topnav">
                <div class="search-container">
                     <a href="logout.php" class="no_underline"><input type="submit" name="logout" class="" value="Log out"></a>  
                </div> -->
               <!-- <a href='../index.php'>Back to Home</a> -->
                <div class="admin" style="padding-left:16px">
                    <a href="../user-profile/adminprofile.php" class="adminpanel">Exit Admin Panel</a>
                </div>  
		    </div>

	     </div>
    
      
    
        <div>
            <?php $results = mysqli_query($db, "SELECT * FROM tbl_users"); ?>
                    <table class="">
                        <thead class="">
                            <tr class="">
                                <th>Username</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Birthday</th>
                                <th>Mobile Number</th>
                            </tr>     	
                        </thead>
                    
                        
                        <!-- loop for displaying the records from our table -->
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td class=""><?php echo $row['username']; ?></td>
                                <td><?php echo $row['user_type']; ?></td>
							    <td><?php echo $row['status']; ?></td>
                                <td class=""><?php echo $row['password']; ?></td>
                                <td class=""><?php echo $row['email']; ?></td>
                                <td class=""><?php echo $row['fname']; ?></td>
                                <td class=""><?php echo $row['lname']; ?></td>
                                <td class=""><?php echo $row['bday']; ?></td>
                                <td class=""><?php echo $row['contact_no']; ?></td>
                                <td>
                                    <a href="administrator.php?edit=<?php echo $row['user_id']; ?>" class="edit_btn" >Edit</a>
                                </td>
                                <td>
                                    <a href="administrator.php?del=<?php echo $row['user_id']; ?>" class="del_btn"> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>     
                    </table>
                </div>    
                <br>
                    <!-- $conn->close(); -->
            </div>

        <FORM enctype="multipart/form-data" method="POST" action="administrator.php" class="div-form">
            <b class="adminpanel">Add User</b>
            <div class="input-group">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <label for="uName" class="signup-style"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uName" value="<?php echo $uName; ?>" >
            </div>
            <div class="input-group">
                <label for="psw" class="signup-style"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw"  value="<?php echo $psw; ?>"  >
            
            </div>
            <div class="input-group"> 
                <label for="cpsw" class="signup-style"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="cpsw"  value="<?php echo $cpsw; ?>"  >
            </div>
            <div class="input-group"> 
                <label for="email" class="signup-style"><b>Email Address</b></label>
                <input type="text" placeholder="Enter Email Address" name="email"  value="<?php echo $email; ?>"  >
            </div>
            <div class="input-group"> 
                <label for="fName" class="signup-style"><b>First Name</b></label>
                <input type="text" placeholder="First Name" name="fName"   value="<?php echo $fName; ?>" >
            </div>
            <div class="input-group"> 
                <label for="mName" class="signup-style"><b>Middle Name</b></label>
                <input type="text" placeholder="Middle Name" name="mName"  value="<?php echo $mName; ?>"  >
            </div>
            <div class="input-group">
                <label for="lName" class="signup-style"><b>Last Name</b></label>
                <input type="text" placeholder="Last Name" name="lName"  value="<?php echo $lName; ?>"  >
            </div>
            <div class="input-group">
                <label for="bday" class="signup-style"><b>Birthday: &nbsp</b></label>
                <input type="date" placeholder="Last Name" name="bday"  value="<?php echo $bday; ?>"  ><br>
            </div>
            <div class="input-group">
                <label for="contact_no" class="signup-style"><b>Contact No.</b></label>
                <input type="text" placeholder="Contact No." name="contact_no"  value="<?php echo $contact_no; ?>"  > <!-- removed pattern -->
            </div>
          
            <label for="city" class="signup-style"  value="<?php echo $cities; ?>"><b>City :</b> </label>
                <select name="cities" id="cities" class="signup-style"  value="<?php echo $cities; ?>" >
                    <option value="#">Select City</option>
                    <option value="Caloocan">Caloocan</option>
                    <option value="Las Piñas">Las Piñas</option>
                    <option value="Makati ">Makati </option>
                    <option value="Malabon">Malabon</option>
                    <option value="Mandaluyong">Mandaluyong</option>
                    <option value="Manila">Manila</option>
                    <option value="Marikina">Marikina</option>
                    <option value="Muntinlupa">Muntinlupa</option>
                    <option value="Navotas">Navotas</option>
                    <option value="Parañaque">Parañaque</option>
                    <option value="Pasay">Pasay</option>
                    <option value="Pasig ">Pasig </option>
                    <option value="Quezon City">Quezon City</option>
                    <option value="San Juan">San Juan</option>
                    <option value="Taguig">Taguig</option>
                    <option value="Valenzuela">Valenzuela</option>
                    <option value="Butuan">Butuan</option>
                    <option value="Cabadbaran">Cabadbaran</option>
                    <option value="Bayugan">Bayugan</option>
                    <option value="Legazpi">Legazpi</option>
                    <option value="Ligao">Ligao</option>
                    <option value="Tabaco">Tabaco</option>
                    <option value="Isabela">Isabela</option>
                    <option value="Lamitan">Lamitan</option>
                    <option value="Balanga">Balanga</option>
                    <option value="Batangas City">Batangas City</option>
                    <option value="Lipa">Lipa</option>
                    <option value="Tanauan">Tanauan</option>
                    <option value="Baguio">Baguio</option>
                    <option value="Tagbilaran">Tagbilaran</option>
                    <option value="Malaybalay">Malaybalay</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Malolos">Malolos</option>
                    <option value="Meycauayan">Meycauayan</option>
                    <option value="San Jose del Monte">San Jose del Monte</option>
                    <option value="Tuguegarao">Tuguegarao</option>
                    <option value="Iriga">Iriga</option>
                    <option value="Naga">Naga</option>
                    <option value="Roxas">Roxas</option>
                    <option value="Bacoor">Bacoor</option>
                    <option value="Cavite City">Cavite City</option>
                    <option value="Dasmariñas">Dasmariñas</option>
                    <option value="Imus">Imus</option>
                    <option value="Tagaytay">Tagaytay</option>
                    <option value="Trece Martires">Trece Martires</option>
                    <option value="Bogo">Bogo</option>
                    <option value="Carcar">Carcar</option>
                    <option value="Cebu City">Cebu City</option>
                    <option value="Danao">Danao</option>
                    <option value="Lapu-Lapu">Lapu-Lapu</option>
                    <option value="Mandaue">Mandaue</option>
                    <option value="Naga">Naga</option>
                    <option value="Talisay">Talisay</option>
                    <option value="Toledo">Toledo</option>
                    <option value="Kidapawan">Kidapawan</option>
                    <option value="Panabo">Panabo</option>
                    <option value="Samal">Samal</option>
                    <option value="Tagum">Tagum</option>
                    <option value="Davao City">Davao City</option>
                    <option value="Digos">Digos</option>
                    <option value="Mati">Mati</option>
                    <option value="Borongan">Borongan</option>
                    <option value="Batac">Batac</option>
                    <option value="Laoag">Laoag</option>
                    <option value="Candon">Candon</option>
                    <option value="Vigan">Vigan</option>
                    <option value="Iloilo City">Iloilo City</option>
                    <option value="Passi">Passi</option>
                    <option value="Cauayan">Cauayan</option>
                    <option value="Ilagan">Ilagan</option>
                    <option value="Santiago">Santiago</option>
                    <option value="Tabuk">Tabuk</option>
                    <option value="San Fernando">San Fernando</option>
                    <option value="Biñan">Biñan</option>
                    <option value="Cabuyao">Cabuyao</option>
                    <option value="Calamba">Calamba</option>
                    <option value="San Pablo">San Pablo</option>
                    <option value="Santa Rosa">Santa Rosa</option>
                    <option value="San Pedro">San Pedro</option>
                    <option value="Iligan">Iligan</option>
                    <option value="Marawi">Marawi</option>
                    <option value="Baybay">Baybay</option>
                    <option value="Ormoc">Ormoc</option>
                    <option value="Tacloban">Tacloban</option>
                    <option value="Cotabato City">Cotabato City</option>
                    <option value="Masbate City">Masbate City</option>
                    <option value="Oroquieta">Oroquieta</option>
                    <option value="Ozamiz">Ozamiz</option>
                    <option value="Tangub">Tangub</option>
                    <option value="Cagayan de Oro">Cagayan de Oro</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Gingoog">Gingoog</option>
                    <option value="Bacolod">Bacolod</option>
                    <option value="Bago">Bago</option>
                    <option value="Cadiz">Cadiz</option>
                    <option value="Escalante">Escalante</option>
                    <option value="Himamaylan">Himamaylan</option>
                    <option value="Kabankalan">Kabankalan</option>
                    <option value="La Carlota">La Carlota</option>
                    <option value="Sagay">Sagay</option>
                    <option value="San Carlos">San Carlos</option>
                    <option value="Silay">Silay</option>
                    <option value="Sipalay">Sipalay</option>
                    <option value="Talisay">Talisay</option>
                    <option value="Victorias">Victorias</option>
                    <option value="Bais">Bais</option>
                    <option value="Bayawan">Bayawan</option>
                    <option value="Canlaon">Canlaon</option>
                    <option value="Dumaguete">Dumaguete</option>
                    <option value="Guihulngan">Guihulngan</option>
                    <option value="Tanjay">Tanjay</option>
                    <option value="Cabanatuan">Cabanatuan</option>
                    <option value="Gapan">Gapan</option>
                    <option value="Muñoz">Muñoz</option>
                    <option value="Palayan">Palayan</option>
                    <option value="San Jose">San Jose</option>
                    <option value="Calapan	Oriental">Calapan	Oriental</option>
                    <option value="Puerto Princesa">Puerto Princesa</option>
                    <option value="Angeles">Angeles</option>
                    <option value="Mabalacat ">Mabalacat </option>
                    <option value="San Fernando">San Fernando</option>
                    <option value="Alaminos">Alaminos</option>
                    <option value="Dagupan">Dagupan</option>
                    <option value="San Carlos">San Carlos</option>
                    <option value="Urdaneta">Urdaneta</option>
                    <option value="Lucena">Lucena</option>
                    <option value="Tayabas">Tayabas</option>
                    <option value="Antipolo">Antipolo</option>
                    <option value="Calbayog">Calbayog</option>
                    <option value="Catbalogan">Catbalogan</option>
                    <option value="Sorsogon City">Sorsogon City</option>
                    <option value="General Santos">General Santos</option>
                    <option value="Koronadal">Koronadal</option>
                    <option value="Maasin">Maasin</option>
                    <option value="Tacurong">Tacurong</option>
                    <option value="Surigao City">Surigao City</option>
                    <option value="Bislig">Bislig</option>
                    <option value="Tandag">Tandag</option>
                    <option value="Tarlac City">Tarlac City</option>
                    <option value="Olongapo">Olongapo</option>
                    <option value="Dapitan">Dapitan</option>
                    <option value="Dipolog">Dipolog</option>
                    <option value="Pagadian">Pagadian</option>
                    <option value="Zamboanga City">Zamboanga City</option>
                </select><br>
            </div>
          
            <div class="input-group">
                <?php if ($update == true): ?>
                    <input type="submit" name="btnupdate" style="background: #556B2F;" value="Update" >
                <?php else: ?>
                    <input type="submit" name="btnsave" style="background: #556B2F;" value="Save" >
                <?php endif ?>
            </div>   		
        </FORM>

		</div>


























	</body>



	
</html>



