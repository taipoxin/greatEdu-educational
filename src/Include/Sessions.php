<?php
session_start();

function Message()
{
  if (isset($_SESSION['errorMessage'])) {
    $ouput = "
			<div class='alert alert-danger'>" .
    $_SESSION["errorMessage"] .
      "</div>
		";
    $_SESSION['errorMessage'] = null;
    return $ouput;
  }
}

function SuccessMessage()
{
  if (isset($_SESSION['successMessage'])) {
    $ouput = "
			<div class='alert alert-success'>" .
    htmlentities($_SESSION["successMessage"]) .
      "</div>
		";
    $_SESSION['successMessage'] = null;
    return $ouput;
  }
}

// retrieve info from session
function SESSION_INFO()
{
  // if (isset($_SESSION["user_id"])) {
  //   $ouput = "
	// 		<div class='alert alert-success'>" . ' User_id: ' .
  //   htmlentities($_SESSION["user_id"]) . ' <br>Username: ' .
  //   htmlentities($_SESSION["username"]) .
  //     "</div>
	// 	";
  //   return $ouput;
  // }
}

function IsLogin()  // boolean
{
  $login = false;
  if (isset($_SESSION['user_id'])) {
    $login = true;
  }
  return $login;
}

function loginRequired() // null / Redirect
{
  $login = false;
  if (isset($_SESSION['user_id'])) {
    $login = true;
  }
  if ($login === false) {
    $_SESSION['errorMessage'] = 'Login Required';
    Redirect_To('/Login.php');
  }
}
