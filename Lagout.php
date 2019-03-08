<?php require_once 'Include/Sessions.php'?>
<?php require_once 'Include/commonFuncs.php'?>
<?php // TODO: not tested
$_SESSION['user_id'] = null;
session_destroy();
Redirect_To('Login.php');
