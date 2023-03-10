<?php
//adding server name,user name,password &db name
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//else part
//whenconnection success
echo "";
?>
