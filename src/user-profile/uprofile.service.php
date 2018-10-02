<?php

function getUserProfile( $userId)
{

    include '../../config/config.php';
    $conn = new mysqli($host, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlGetUserData = 'SELECT
                     *
                     FROM tbl_users u
                     INNER JOIN tbl_file f
                     ON u.tbl_file_file_id = f.file_id
                     INNER JOIN tbl_address a
                     ON u.tbl_address_address_id = a.address_id
                     WHERE u.user_id =' . $userId;
    $result = $conn->query($sqlGetUserData) or die($conn->error);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           $_SESSION['user_data'] = $row;
        }

        getUserPet($userId);
        exit;

    } else {
        echo $sqlGetUserData;
        echo "No User Available";
    }

    $conn->close();
}

function updateUserProfile($uname, $fname, $mname, $lname, $email, $contactNo, $bday, $houseNo, $streetName, $subdivison, $barangay, $city, $province, $zipCode, $user_id)
{
    include '../../config/config.php';
    $conn = new mysqli($host, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     $sqlGetAddressId = 'SELECT * from tbl_users u
                      WHERE u.user_id = '.$user_id;

    $result = $conn->query($sqlGetAddressId) or die($sqlGetAddressId);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $address_id = $row['tbl_address_address_id'];
        }
    } else {
        echo $sqlUpdateUser;
        echo "No Address ID Available";
    }


    $sqlUpdateUser = 'UPDATE tbl_users u
                      SET
                        username ="'.$uname.'",
                        fname = "'.$fname.'",
                        mname = "'.$mname.'",
                        lname = "'.$lname.'",
                        email = "'.$email.'",
                        contact_no = "'.$contactNo.'",
                        bday = "'.$bday.'"
                      WHERE u.user_id ='.$user_id;

    $result = $conn->query($sqlUpdateUser) or die($sqlUpdateUser);

    $sqlUpdateAddress = 'UPDATE tbl_address a
                      SET
                        house_no = "'.$houseNo.'",
                        streetname = "'.$streetName.'",
                        subd = "'.$subdivison.'",
                        brgy = "'.$barangay.'",
                        city = "'.$city.'",
                        zipcode = "'.$zipcode.'",
                        province = "'.$province.'"
                      WHERE a.address_id =' . $address_id;

    $result = $conn->query($sqlUpdateUser) or die($sqlUpdateAddress);
    header('location: uprofile.controller.php?id='.$user_id);

    $conn->close();
}

function getUserPet( $userId)
{
    $pet_data = array();
    include '../../config/config.php';
    $conn = new mysqli($host, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlGetUserPet = 'SELECT
                     *
                     FROM tbl_pets p
                     INNER JOIN tbl_file f
                     ON p.tbl_file_file_id = f.file_id
                     WHERE p.tbl_users_user_id='.$userId;

    $result = $conn->query($sqlGetUserPet) or die($conn->error);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($pet_data, $row);
        }

        $_SESSION['pet_data'] = $pet_data;
        getUserNotification($userId);
        exit;

    } else {
        $_SESSION['pet_data'] = array();

        getUserNotification($userId);
    }

    $conn->close();
}

function getUserNotification($userId)
{
    $user_notifications = array();

    include '../../config/config.php';
    $conn = new mysqli($host, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlGetUserNotifications = 'SELECT
                     u.fname,
                     p.petname,
                     n.interest_reason,
                     n.notif_id
                     FROM tbl_notif n
                     INNER JOIN tbl_users u
                     ON n.tbl_user_interest_user_id = u.user_id
                     INNER JOIN tbl_adopt_transc t
                     on n.tbl_adopt_transc_transc_id = t.transc_id
                     INNER JOIN tbl_pets p 
                     on t.tbl_pets_pet_id = p.pet_id
                     WHERE n.tbl_user_owner_user_id ='.$userId;

    $result = $conn->query($sqlGetUserNotifications) or die($conn->error);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($user_notifications, $row);
        }

        $_SESSION['user_notifications'] = $user_notifications;
        header("Location: uprofile.php");
        exit;

    } else {
        echo $sqlGetUserNotifications;
        echo "No Notifs Available";
        $_SESSION['user_notifications'] = array();

        header("Location: uprofile.php");

    }

    $conn->close();
}

function getTransaction( $notifId) {
    include '../../config/config.php';
    $conn = new mysqli($host, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlGetTransaction = 'SELECT
                     u.fname,
                     p.petname,
                     n.interest_reason,
                     n.notif_id
                     FROM tbl_notif n
                     INNER JOIN tbl_users u
                     ON n.tbl_user_interest_user_id = u.user_id
                     INNER JOIN tbl_adopt_transc t
                     on n.tbl_adopt_transc_transc_id = t.transc_id
                     INNER JOIN tbl_pets p 
                     on t.tbl_pets_pet_id = p.pet_id
                     WHERE n.notif_id ='.$notifId;

    $result = $conn->query($sqlGetTransaction) or die($conn->error);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['user_transaction'] = $row;
        }

        header("Location: respond-to-notif.php");
        exit;

    } else {
        echo $sqlGetTransaction;
        echo "No Transaction Available";
        header("Location: uprofile.php");
    }

    $conn->close();
}

function respondToNotification($isAccepted, $notifId, $message)
{
   include '../../config/config.php';
   $conn = new mysqli($host, $username, $password, $db);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   if($isAccepted == 0 || $isAccepted == '0') {
    $sqlUpdateNotif = 'UPDATE tbl_notif 
                        SET
                        is_accepted = 0,
                        rejection_reason = "'.$message.'",
                        accepted_reason = ""
                        WHERE notif_id ='. $notifId;
   } else {
    $sqlUpdateNotif = 'UPDATE tbl_notif
                        SET
                        is_accepted = 1,
                        accepted_reason = "'.$message.'",
                        rejection_reason = ""
                        WHERE notif_id ='. $notifId;
   }

   $result = $conn->query($sqlUpdateNotif) or die($sqlUpdateNotif);
    header('Location: uprofile.php');
    if ($result->num_rows > 0) {

        header('Location: uprofile.php');
        exit;
    }

    header('Location: uprofile.php');


   $conn->close();

}

