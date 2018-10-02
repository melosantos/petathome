<?php
include '../../config/config.php';
include '../../config/ChromePhp.php';

$pet_list = $_SESSION['pet_list'];
$user_id = $_SESSION['user_id'];

ChromePhp::log('PET LIST:');
ChromePhp::log($pet_list);


ChromePhp::log('USER ID:');
ChromePhp::log($user_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
    <link rel="stylesheet" type="text/css" href="adoption-list.css">
	<link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">


</head>
<body>
	<div class="topnav">
        <a href='../registration/petreg.php'>Donate Pets</b>
        <div id="right">
            <a href="../user-profile/uprofile.controller.php?id=<?php echo $user_id?>">My Profile</a>
            <a href='../index.php?logout=1'> Log Out </a> 
        </div>
        
	</div>
    <?php
    echo   '<div class="list-container">';
    if(isset($pet_list)) {
        foreach ($pet_list as $key => $value) {
            echo       '<div class="card">';
            echo           '<div class="card-image">'; 
            echo               '<img width="300" src="../../img/'.$value['file_name'].'">';
            echo           '</div>';
            echo           '<div class="card-content">';
            echo               $value['petname'],' <br> '.$value['breed'];
            echo                '<div class="spacer"></div>';
            echo               '<a href="adoption-confirmation.php?createNotif=true&ownerId='.$value['user_id'].'&interestId='.$user_id.'&transactionId='.$value['transc_id'].'" class="adopt-button">ADOPT ME</a>';
            echo           '</div>';
            echo       '</div>'; 
        }
    } else {
        echo '<div class="no-pets">';
        echo "No Pets Available for Adoption";
        echo '</div>';
    }

    echo   '</div>';
    ?>
	</body>
	</html>
