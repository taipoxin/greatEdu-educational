<?php

function validateNewUser($username, $email, $password, $confirmPassword)
{
  if (empty($username) || empty($password)
    || empty($confirmPassword) || empty($email)) {
    $_SESSION['errorMessage'] = 'All Fields Must Be Fill Out';
    return false;
  }
  if ($password != $confirmPassword) {
    $_SESSION['errorMessage'] = 'Password and Confirmation Password are not the same';
    return false;
  }
  if (strlen($password) < 2) {
    $_SESSION['errorMessage'] = 'Password Must Be 2 Or More Characters';
    return false;
  }
  $isExists = isUserExistsByUsername($username);
  if ($isExists) {
    $_SESSION['errorMessage'] = "User $username already registered";
    return false;
  }
  return true;

}

function writeUser($username, $email, $passwordHash, $dateTime)
{
  $status = 1;
  $group = 1;
  $sql = "INSERT INTO Пользователи
  (никнейм, почта, хэш_пароля, статус, группа, дата_регистрации, дата_изменения)
  VALUES('$username', '$email', '$passwordHash', $status, $group, '$dateTime', '$dateTime')";
  return doSQLQuery($sql);
}
function selectUserId($username)
{
  $sql = "SELECT id, никнейм FROM Пользователи WHERE никнейм = '$username'";
  $exec = doSQLQuery($sql);
  if ($user = mysqli_fetch_assoc($exec)) {
    return $user;
  }
  return null;
}

function register()
{
  global $_POST, $_SESSION;
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];

  $validationResult = validateNewUser($username, $email, $password, $confirmPassword);
  if ($validationResult) {
    // register this

    $time = time();
    $dateTime = strftime('%Y-%m-%d %H:%M:%S ', $time);
    $result = writeUser($username, $email, $password, $dateTime);
    if ($result) {
      $_SESSION['successMessage'] = 'You are registered successfully';
      $userObj = selectUserId($username);
      $_SESSION['user_id'] = $userObj['id'];
      $_SESSION['username'] = $userObj['никнейм'];
      // echo 'before success redirect <br>';
      Redirect_To('/');
    } else {
      $_SESSION['errorMessage'] = 'Something Went Wrong Please Try Again Later';
      // echo 'before failure redirect <br>';
      Redirect_To('Register.php');
    }
  } else {
    Redirect_To('Register.php');
  }
}

if (isset($_POST['submit'])) {
  register();
}
