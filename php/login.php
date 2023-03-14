<?php
	
//Getting form data and store in variables
$userEmail = $_POST["userEmail"];
$userPassword = $_POST["userPassword"];

session_start();

//Creating a connection with database
global $connection;
$connection = new mysqli("localhost", "root", "", "newuserdb");

//SQL Query 
$sqlCmd = "SELECT * FROM user WHERE userEmail = '$userEmail'";

$resultSet = $connection->query($sqlCmd);
$connection->close();

//Checking whether the resuslts are available or not 
if ($resultSet->num_rows > 0) {

	$_SESSION["currentUser"] = $userEmail;

    //Immediate direction to the User Profile
	header("Location: ../userProfile.html"); 	
}
else{

	//JS code to direct user to relevent pages if login details are not available
	
	echo '<script>

	 if(confirm("Invalid username or password"))
	 {
	 	window.location.replace("../login.html");
	 }else{
	 	window.location.replace("../userProfile.html");
	 } 

	 </script>';
	
}

?>