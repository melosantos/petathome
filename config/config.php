<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "id7163051_petathomedb";

	if($_GET['logout'] == 1){
		$_SESSION['fname']="";
	 	$_SESSION['lname']="";
	 	$_SESSION['user_type']="";


	 	  	$_SESSION['user_id']   = "";
            $_SESSION['user_type'] ="";
            $_SESSION['fname']     = "";
            $_SESSION['lname']     = "";

        session_destroy();
        header ('location: index.php');

	 }

	 
?>
