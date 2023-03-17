<?php
//starting session
session_start();

if(!isset($_SESSION["currentUser"])){
	header("Location: ../login.html");
}

else{

	//starting connection with the database
	global $connection;

	// Retrieve the user information from the database
	$currentUser = $_SESSION["currentUser"];

	$connection = new mysqli("localhost", "root", "", "newuserdb");
	$sqlCmd = "SELECT * FROM user WHERE userEmail = '$currentUser'";
	$resultSet = $connection->query($sqlCmd);
	$row = $resultSet->fetch_assoc();

	$userId = $row["userId"]; 
	$firstName = $row["firstName"];
	$lastName = $row["lastName"];
	$userEmail = $row["userEmail"];
	$image = $row["image"];
	// Pw is not shown in the prfile

	// Retrieve the user image from the database
	$sqlCmd = "SELECT image FROM user WHERE userEmail = '$currentUser'";
	$resultSet = $connection->query($sqlCmd);
	$image = $resultSet->fetch_assoc();
}

$connection->close();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
    <link rel="stylesheet" type="text/css" href="../css/profileStyles.css">
</head>

<body>


<div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
    <div class="card p-4"> <div class=" image d-flex flex-column justify-content-center align-items-center"> 
       <div>
			<!-- take the image from the login user -->
	   		<!-- image passing -->
			<img src="../images/<?php echo $row["image"]; ?>" height="200" width="150"alt="Profile Picture"/>
        
	   </div>
	   <br>
	   <br>
	
		<span class="name mt-3"><?php echo $row["firstName"]; ?> <?php echo $row["lastName"]; ?></span> 
        <span class="name mt-3"><?php echo $row["userEmail"];?> </span>

	
		
		
        <div class=" d-flex mt-2"> 
            <button class="btn1 btn-sucess">Edit Profile</button>
        </div> 
        
            
            <div class=" px-2 rounded mt-4 date "> 
                <span class="join"> LOGOUT </span>
            </div>

        </div>
</body>
</html>
