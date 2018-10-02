<?php
    include '../../config/config.php';
    include '../../config/ChromePhp.php';
    
    $user_transaction = $_SESSION['user_transaction'];
    ChromePhp::log('USER transaction:');
    ChromePhp::log($_SESSION['user_transaction']);

    if(isset($_POST['reject'])) {
        header('Location: ../user-profile/uprofile.controller.php?notifId='.$user_transaction['notif_id'].'&isAccepted=0&message='.$_POST['rejectionMessage']);
    }
    if(isset($_POST['accept'])) {
        header('Location: ../user-profile/uprofile.controller.php?notifId='.$user_transaction['notif_id'].'&isAccepted=1&message='.$_POST['acceptanceMessage']);
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Transaction</title>
	<link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
    <div class="topnav">
		<a href='uprofile.php'>Go Back</a>
    </div>
    
    <div class="confirm-container">
        <div class="want-to-adopt">
            <?php echo $user_transaction['fname']." wants to adopt ".$user_transaction['petname']; ?>
        </div>

        <div class="adopt-says">
            <?php echo $user_transaction['fname']." says: ".$user_transaction['interest_reason']; ?>
        </div>

        <div class="confirm-buttons">
            <button onclick="showMessage(true)" class="acceptBtn">ACCEPT</button>
            <button onclick="showMessage(false)" class="rejectBtn">REJECT</button>
        </div>

        <script>
            function showMessage(hide) {
                var a = document.getElementById("accept");
                var r = document.getElementById("reject");
                if (hide) {
                    a.style.display = "block";
                    r.style.display = "none";
                } else {
                    r.style.display = "block";
                    a.style.display = "none";
                }
            }

            function goBack() {
                history.go(-1);
            }
        </script>
        <div class="message">
            <div id="accept">
                <h2>Tell him/her something!</h2>
            <form action="respond-to-notif.php" method="POST">
                <textarea name="acceptanceMessage" rows="10" cols="30"></textarea>
                <br>
                <input type="submit" name="accept" class="acceptBtn" onclick="goBack()">
            </form>

            </div>

            <div id="reject">
                <h2>Ouch! Can you tell him/her what's wrong?</h2>

                <form action="respond-to-notif.php" method="POST">
                    <textarea name="rejectionMessage" rows="10" cols="30"></textarea>
                    <br>
                    <input type="submit" name="reject" class="acceptBtn">
                </form>
            </div>
        </div>
    
    </div>

</body>
</html>