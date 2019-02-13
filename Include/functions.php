<?php
require_once('Database.php');

function Redirect_To ($location) {
	header('location:' . $location);
	exit;
}  

function Query ($query) {
	global $con;

	try {

		$exec = mysqli_query($con,$query) or die(mysqli_error($con));
		if($exec) {
			return $exec;
		}
	
	}catch (Exception $e) {
		echo $e->getMessage();
	}

	return false;
}

function QueryNew ($query) {
	global $con2;

	try {

		$exec = mysqli_query($con2,$query) or die(mysqli_error($con2));
		if($exec) {
			return $exec;
		}
	
	}catch (Exception $e) {
		echo $e->getMessage();
	}

	return false;
}

function LoginAttempt($username, $password) {
	// $query = "SHOW TABLES";
	// $query = "SELECT * FROM cms_admin WHERE username = '$username'  AND password = '$password'";
	$query = "SELECT * FROM `Пользователи` WHERE `никнейм` = '$username'  AND `хэш_пароля` = '$password'";
	$exec = QueryNew($query); 
	// Tables_in_great_edu
	// return $exec;
	if ($admin = mysqli_fetch_assoc($exec)) {
		return $admin;
	}else {
		return null;
	}

}

?>