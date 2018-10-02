<?php 
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);
	$db = mysqli_connect('localhost', 'root', '', 'id7163051_petathomedb');

	// initialize variables
	//$name = "";
	//$address = "";
    
    $uName = "";
    $psw =   "";
    $cpsw = "";
    $email = "";
    $fName = "";
    $mName = "";
    $lName = "";
    $bday  = "";
    $contact_no = "";
    $houseNo = "";
    $stName = "";
    $subd = "";
    $brgy = "";
    $cities = "";
    $provinces = "";
    $zip = "";

    $user_id = 0; //is this 0 or ''
	$update = false;

    /*    
    //add new account
	if (isset($_POST['save'])) {
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

        /* SAMPLE
		mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
		$_SESSION['message'] = "Address saved"; 
        header('location: index.php'); */
        /*        
        if ($psw != $cpsw) {
        echo '<div class="pw-notmatch">' . $notMatch . '</div>';
        } else {
            $db = mysqli_connect('localhost', 'root', '', 'petathomedb');
            $conn = new mysqli("localhost", "root", "", "petathomedb");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    //Persist Address to DB
                    $strInsertAddress = "INSERT INTO tbl_address(house_no,streetname, subd, brgy, city, province, zipcode)
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
            
            
            
                        header("Location: view_users.php");
                    } else {
                        echo "no address id created or file id!";
                    }

                    $conn->close();
                }
            } 
        }        
    }*/
    
    /*
    //edit a user account
    if (isset($_POST['btnupdate'])) {

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
        $zip        = $_POST['zip']; */


        /*
        //Persist Address to DB --added
        $strInsertAddress = "UPDATE tbl_address(house_no, streetname, subd, brgy, city, province, zipcode)
        VALUES ('$houseNo', '$stName', '$subd', '$brgy', '$cities', '$provinces', '$zip')";
        $conn->query($strInsertAddress) or die($conn->error);
        $address_id = $conn->insert_id;
        
        //Persist File to DB --added
        $strInsertFile = "UPDATE tbl_file(file_type, file_size)
        VALUES ('n/a', 200)";
        $conn->query($strInsertFile) or die($conn->error);
        $file_id = $conn->insert_id;

        
        if ($address_id && $file_id) {
            //Persist User
            $strInsertUser = "UPDATE tbl_users(username,password,email,fname,mname,lname,bday,contact_no,tbl_address_address_id,tbl_file_file_id)
            VALUES ('$uName','$psw','$email','$fName','$mName','$lName', '$bday', '$contact_no', '$address_id', '$file_id')";

            $conn->query($strInsertUser) or die($conn->error); 
        } */
        /*mysqli_query($db, "UPDATE tbl_users SET username='$uName', password='$psw', email='$email', fname='$fName', mname='$mName', lname='$lName', bday='$bday' WHERE user_id=$user_id");
        $_SESSION['message'] = "Account updated!"; 
        
        //header('location: view_users.php');
    } */


   


?>