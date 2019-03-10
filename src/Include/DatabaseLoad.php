<?php
// connect to database

$server = 'localhost';
$username = 'tiranid';
$password = ' ';
global $con2;

try {
  $con2 = mysqli_connect($server, $username, $password, 'great_edu') or die(mysqli_connec_errno());
  if ($con2) {
    mysqli_set_charset($con2, "utf8");
  }

} catch (Exception $e) {
  echo $e->getMessage();
}
