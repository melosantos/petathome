<?php
include 'uprofile.service.php';
include '../../config/ChromePhp.php';

parse_str($_SERVER['QUERY_STRING'], $params);
if (count($params)) {
    if (array_key_exists("id",$params)) {
        getUserProfile($params['id']);
    }

    if(array_key_exists("notifId", $params) && array_key_exists("isAccepted", $params)) {
        respondToNotification($params['isAccepted'], $params['notifId'], $params['message']);
        header("Location: uprofile.php");
        
    }

    if(array_key_exists("notifId",$params)) {
        getTransaction($params['notifId']);
    }

    if(array_key_exists("updateUser", $params)) {
        updateUserProfile($params['username'], $params['fname'], $params['mname'], $params['lname'], $params['email'], $params['contactNo'], $params['bday'], $params['houseNo'], $params['streetName'], $params['subdivision'], $params['barangay'], $params['city'], $params['province'], $params['zipCode'], $params['userId']);
    }

} else {
    echo "GET ALL PETS";
}

?>