<?php
//Turn on error reporting
ini_set('display_errors', 'On');

//database variables
$dbhost = 'mysql.eecs.oregonstate.edu';
$dbuser = 'cs419-g14';
$dbpass = 'fhN8WsZMqhcSSrLB';
$dbname = 'cs419-g14';

//Connects to the database
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//echo "Connection was successful";

//errors for debugging purposes
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

//error output for users
//if($mysqli->connect_errno){
//	die("Sorry, we are having come technical problems. Please try again later");
//}
 ?>