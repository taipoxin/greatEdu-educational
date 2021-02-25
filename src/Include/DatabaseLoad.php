<?php
// connect to database

$server = 'great_edu_mysql:3306';
$username = 'test';
$password = 'test';
global $con2;

try {
  $con2 = mysqli_connect($server, $username, $password, 'test') or die(mysqli_connec_errno());
  if ($con2) {
    mysqli_set_charset($con2, "utf8");
  }

} catch (Exception $e) {
  echo $e->getMessage();
}
