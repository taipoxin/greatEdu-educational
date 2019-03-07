<?php
$server = 'localhost';
$username = 'tiranid';
$password = ' ';
$db_name = 'cms_blog';
// $con;
global $con2;

try {
  // TODO: old
  $con2 = mysqli_connect($server, $username, $password, 'great_edu') or die(mysqli_connec_errno());
  mysqli_set_charset($con2, "utf8");

} catch (Exception $e) {
  echo $e->getMessage();
}
