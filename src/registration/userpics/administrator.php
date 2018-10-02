<?php


$conn = new mysqli("localhost", "groot", "Admin1996!", "catsdb");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 

$txtSearch = $_POST['txtsearch'];

if(!empty($txtSearch)) {
	$sqlSelect = "SELECT * from tbl_users
	WHERE Email LIKE '%$txtSearch%' OR Username LIKE '%$txtSearch%'";
	$result = $conn->query($sqlSelect);


	if ($result->num_rows > 0) {
		echo '<div class="dbstyle">';

		while($row = $result->fetch_assoc()) {
			echo "<b>Username: </b>".$row['username'];
			echo "&nbsp<b>Password: </b>".$row['password'];
			echo "&nbsp<b>Email: </b>".$row['email'];
			echo "&nbsp<b>First Name: </b>".$row['fname'];
			echo "&nbsp<b>Last Name: </b>".$row['lname'];
			echo "&nbsp<b>City: </b>".$row['city'];
		}

		echo '</div>';
		echo "<br>";
	} else {
		echo "No results found";
	}
	$conn->close();
}


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<style>
	* {box-sizing: border-box;}

	body {
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;
	}

	.topnav {
		overflow: hidden;
		background-color: #e9e9e9;
	}

	.topnav a {
		float: left;
		display: block;
		color: black;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 17px;
	}

	.topnav a:hover {
		background-color: #ddd;
		color: black;
	}

	.topnav a.active {
		background-color: #2196F3;
		color: white;
	}

	.topnav .search-container {
		float: right;
	}

	.topnav input[type=text] {
		padding: 6px;
		margin-top: 8px;
		font-size: 17px;
		border: none;
	}

	.topnav .search-container button {
		float: right;
		padding: 6px 10px;
		margin: 8px 0px;
		margin-right: 16px;
		background: #ddd;
		font-size: 17px;
		border: none;
		cursor: pointer;
	}

	.topnav .search-container button:hover {
		background: #ccc;
	}

	.dbstyle {
		font-family: 'Quicksand', sans-serif;
		position: absolute;
		font-size: 1em;
		margin-top: 10%;
	}
	@media screen and (max-width: 600px) {
		.topnav .search-container {
			float: none;
		}
		.topnav a, .topnav input[type=text], .topnav .search-container button {
			float: none;
			display: block;
			text-align: left;
			width: 100%;
			margin: 0;
			padding: 14px;
		}
		.topnav input[type=text] {
			border: 1px solid #ccc;  
		}

	}
</style>
</head>
<body>

	<div class="topnav">
		<div class="search-container">
			<form method="POST">
				<input type="text" placeholder="Search.." name="txtsearch">
				<input type="submit" value="Go">
			</form>
		</div>
	</div>

	<div style="padding-left:16px">
	</div>

</body>
</html>



