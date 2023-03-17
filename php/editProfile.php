<?php
//starting session for editing profile
session_start();

if(!isset($_SESSION["currentUser"])){
	header("Location: ../html/login.html");
}
else{
// starting the connection with the database
	global $con;
	$currentUserName = $_SESSION["currentUser"];

	$con = new mysqli("localhost", "root", "", "advistalk");
	$sqlCmd = "SELECT * FROM userprofile WHERE userName = '$currentUserName'";
	$resultSet = $con->query($sqlCmd);
	$row = $resultSet->fetch_assoc();
	$con->close();

	$userID = $row["userID"]; 
	$firstName = $row["firstName"];
	$lastName = $row["lastName"];
	$strt1 = $row["street1"];
	$strt2 = $row["street2"];
	$city = $row["city"];
	$province = $row["province"];
	$postalCode = $row["postalCode"];
	$country = $row["country"];
	$areaCode = $row["areaCode"];
	$pn = $row["phoneNumber"];
	$userName = $row["userName"];
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<style type="text/css">
		.bodyDiv{
			overflow: hidden;
			padding: 0px;
			margin: 0px;
			padding-top: 2%;
			margin-left: 10%;
		}

		.userProfileValues{
			width: 75%;
		}

		.editProfileSubmitBtn{
			outline: none;
			padding: 8px 16px;
			width: 50%;
			margin-bottom: 12%;
			background-color: transparent;
			border: 2px solid orange;
			border-radius: 10px;
			transition: background-color;
			transition-duration: 0.4s;
		}

		.editProfileSubmitBtn:hover{
			background-color: orange;
			box-shadow: 1px 1px 10px 1px grey;
		}

		.userProfileColumn2{
			padding-top: 3%;
		}
	</style>
</head>

<body>

	<div class="bodyDiv">

		<?php
		echo'<div class="userProfileColumn1">';
		echo'<div class="profileInnerDiv1">'; 
		echo'<div class="userImageDiv">';
		echo'<img class="userImage" src="../images/userprofilePictures/'.$userId.'.jpg" alt="">';
		echo'</div>';
		echo'<form method="post" action="uploadEditedProfile.php">';
		echo '<center><input type="submit" class="editProfileSubmitBtn" name="submit" value="Save"></center>';
		echo'</div>';
		echo'<div class="profileInnerDiv2">';
		echo"<p> First Name     : <input class=\"userProfileValues\" type=\"text\" name=\"newFirstName\" value=\"$firstName\" >";
		echo"<p> Last Name      : <input class=\"userProfileValues\" type=\"text\" name=\"newLastName\" value=\"$lastName\" >";
		echo"<p> email 			: <input class=\"userProfileValues\" type=\"text\" name=\"newUserEmail\" value=\"$userEmail\" >";
		echo'</form>';
		echo'</div>';
		echo'</div>';
		echo'<div class="userProfileColumn2">';
		echo'<div class="profileInnerRow1">';
		echo'<center><a class="userProfileAnchors" href="editProfile.php">Edit Profile</a></center>';
		echo'</div>';
		echo'<div class="profileInnerRow2">';
		echo'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna.</p>';
		echo'</div>';
		echo'</div>';
		?>
		
	</div>

</body>
</html>