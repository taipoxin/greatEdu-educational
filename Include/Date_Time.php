<?php
date_default_timezone_set('Asia/Manila');

$time = time();
$dateTime = strftime('%Y-%m-%d',$time);
echo $dateTime;
?>