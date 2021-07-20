<?php 
	include_once('./config/session.php');

	$server = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'private_diary_db';

	$conn = mysqli_connect($server, $username, $password, $database);

	if(!$conn){
		$_SESSION['ErrorMessage'] = "Failed to connect to databse";
	}


?>