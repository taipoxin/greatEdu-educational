<?php
require_once('Database.php');

function Redirect_To ($location) {
	header('location:' . $location);
	exit;
}  

function LoadText($file) {
	$post_content = '';
	if (is_null($file)) {
		$post_content = 'error load';
	}
	else {
		$post_content = file_get_contents('Upload/contents/' . $file);
	}
	return $post_content;
}



function LoginAttempt($username, $password) {
	$query = "SELECT * FROM `Пользователи` WHERE `никнейм` = '$username'  AND `хэш_пароля` = '$password'";
	$exec = QueryNew($query); 
	// Tables_in_great_edu
	if ($admin = mysqli_fetch_assoc($exec)) {
		return $admin;
	}else {
		return null;
	}

}

?>