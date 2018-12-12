<?php
include '../../config/config.php';

function foo($param) {
    return $param;
}

function getAllPets($pet_type, $breed, $user_id) {
    $pet_list = array();
    include '../../config/config.php';
    $conn = new mysqli($host, $username, $password, $db);
    if ($conn->connect_error) {
        die($sqlString);
    }
    $sqlSelectPets = "SELECT
                     t.transc_id,
                     p.petname,
                     p.breed,
                     p.dsc,
                     u.user_id,
                     u.fname,
                     u.mname,
                     u.lname,
                     u.email,
                     f.file_name,
                     f.file_id,
                     f.file_type
                     FROM tbl_adopt_transc t
                     INNER JOIN tbl_pets p
                     ON t.tbl_pets_pet_id = p.pet_id
                     INNER JOIN  tbl_users u
                     ON p.tbl_users_user_id = u.user_id
                     INNER JOIN tbl_file f
                     ON p.tbl_file_file_id = f.file_id
                     WHERE t.is_adopted = 0
                     AND p.tbl_users_user_id <>".$user_id;
                     
    if($pet_type != '') {
        $sqlSelectPets .= " AND p.pet_type = '$pet_type'";
    }

    if($breed != '') {
        $sqlSelectPets .= " AND p.breed = '$breed'";
    }

    $result = $conn->query($sqlSelectPets) or die($conn->error);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            array_push($pet_list, $row);
        }

        $_SESSION['pet_list'] = $pet_list;
        header("Location: adoption-list.php");
        exit;

    } else {
        header("Location: adoption-list.php");
        echo $sqlSelectPets;
        echo "No Pets Available";
    }

    $conn->close();
}

function createNotification($interestReason, $ownerId, $interestedUserId, $transactionId) {

    include '../../config/config.php';
    $conn = new mysqli($host, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlCreateNotification = "INSERT INTO tbl_notif(
                                interest_reason,
                                tbl_user_owner_user_id,
                                tbl_user_interest_user_id,
                                tbl_adopt_transc_transc_id
                             ) VALUES (
                                 '$interestReason',
                                 '$ownerId',
                                 '$interestedUserId',
                                 '$transactionId'
                             )";
    $result = $conn->query($sqlCreateNotification) or die($sqlCreateNotification);
    header("Location: ../adoption-list/adoption-list.php");
    $conn->close();
}
?>