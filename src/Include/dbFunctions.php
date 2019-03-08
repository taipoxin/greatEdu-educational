<?php
require_once 'DatabaseLoad.php';

// low level query to $con2
function doSQLQuery($query)
{
  global $con2;
  try {
    $exec = mysqli_query($con2, $query) or die(mysqli_error($con2));
    if ($exec) {
      return $exec;
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  return false;
}

// high-level query exec to array result
function execQueryToArray($query)
{
  global $con2;
  $exec = doSQLQuery($query) or die(mysqli_error($con2));
  if ($exec) {
    $arr = [];
    if (mysqli_num_rows($exec) > 0) {
      while ($post = mysqli_fetch_assoc($exec)) {
        array_push($arr, $post);
      }
    }
    return $arr;
  }
  return null;
}

// return true if admin log-inned, redirect to Login if not
function adminRequired()
{
  $admin = false;
  if (isset($_SESSION['user_id'])) {

    $username = $_SESSION['username'];
    // Redirect_To('Login.php');
    $query = "SELECT группа FROM `Пользователи` WHERE `никнейм` = '$username'";
    $exec = doSQLQuery($query);
    if ($group = mysqli_fetch_assoc($exec)) {
      // $_SESSION['errorMessage'] = $group['группа'];
      if ($group['группа'] === '2') {
        $_SESSION['errorMessage'] = null;
        $admin = true;
        return true;
      }
    }
  }
  if ($admin === false) {
    $_SESSION['errorMessage'] = 'Admin Required';
    Redirect_To('Login.php');
  }
}

// return user by id provided
function getUserById($id)
{
  $query = "SELECT * FROM Пользователи WHERE id = $id";
  $resultArray = execQueryToArray($query);
  $author = $resultArray[0];
  return $author;
}

// check by username
function isUserExistsByUsername($username) {
  $query = "SELECT * FROM `Пользователи` WHERE `никнейм` = '$username'";
  $exec = doSQLQuery($query);
  if ($group = mysqli_fetch_assoc($exec)) {
    return true;
  }
  return false;
}