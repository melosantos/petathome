<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'adoption-list.service.php';
parse_str($_SERVER['QUERY_STRING'], $params);
if (count($params)) {
    if (array_key_exists("id",$params)) {
        getAllPets('', '', $params['id']);
    }

    if (array_key_exists("pet_type",$params) || array_key_exists("breed",$params)) {
        getAllPets($params['pet_type'], $params['breed']);
    }

    //if(array_key_exists("createNotif",$params) && $params['createNotif']) {

        //print_r($params);
        //createNotification($params['ownerId'], $params['$interestedId'], $params['transactionId'], $params['message']);
    //}
}
?>