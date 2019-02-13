<?php
$server = 'localhost';
$username = 'tiranid';
$password = ' ';
$db_name = 'cms_blog';
$con;

try{
	$con = mysqli_connect($server, $username, $password, $db_name) or die(mysqli_connec_errno());
	
}catch(Exception $e){
	echo $e->getMessage();
}
?>