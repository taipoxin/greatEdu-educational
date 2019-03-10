<?php
session_start();

function Message()
{
  if (isset($_SESSION['errorMessage'])) {
    $ouput = "
			<div class='alert alert-danger'>" .
    htmlentities($_SESSION["errorMessage"]) .
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
  if (isset($_SESSION["user_id"])) {
    $ouput = "
			<div class='alert alert-success'>" . ' User_id: ' .
    htmlentities($_SESSION["user_id"]) . ' <br>Username: ' .
    htmlentities($_SESSION["username"]) .
      "</div>
		";
    return $ouput;
  }
}

function deleteCategory()
{
  if (isset($_SESSION['optDeleteCategory'])) {
    $opt = "
			<div style='text-align:center;'>
				<span class='lead'>Are You Sure You Want $_SESSION[categoryName]?</span>
				<div class='alert alert-info'>
				<a href='Categories.php?CategoryID=$_SESSION[del_id]'><button class='btn btn-danger btn-lg'>Yes</button></a> | <a href='Categories.php'><button class='btn btn-primary btn-lg'>No</button></a>
				</div>
			</div>
		";
    $_SESSION['optDeleteCategory'] = null;
    $_SESSION['del_id'] = null;
    $_SESSION['optDeleteCategory'] = null;
    $_SESSION['categoryName'] = null;
    return $opt;

  }
}

function IsLogin()
{
  $login = false;
  if (isset($_SESSION['user_id'])) {
    $login = true;
  }
  return $login;
}

function loginRequired()
{
  $login = false;
  if (isset($_SESSION['user_id'])) {
    $login = true;
  }

  if ($login === false) {
    $_SESSION['errorMessage'] = 'Login Required';
    Redirect_To('Login.php');
  }
}