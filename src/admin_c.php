<?php require_once 'Include/Sessions.php'?>
<?php require_once 'Include/functions.php'?>
<?php require_once 'Include/dbFunctions.php'?>
<?php require_once 'Include/Database.php'?>
<?php require_once 'Include/fileFunctions.php'?>

<?php

function addNewAdminQuery($username, $email, $passwordHash, $status, $group, $dateOfRegister, $dateOfUpdate)
{
  $sql = "INSERT INTO Пользователи (никнейм, почта, хэш_пароля, статус, группа, дата_регистрации, дата_изменения)
      VALUES('$username', '$email', '$passwordHash', $status, $group, '$dateOfRegister', '$dateOfUpdate')";
  return QueryNew($sql);
}

function validateNewAdmin($username, $password, $confirmPassword)
{
  if (empty($username) || empty($password) || empty($confirmPassword)) {
    $_SESSION['errorMessage'] = "All Fields Must Be Fill Out $username, $password, $confirmPassword";
    return false;
  } else if (strlen($password) < 2) {
    $_SESSION['errorMessage'] = 'Password Must Be 2 Or More Characters';
    return false;
  } else if ($password !== $confirmPassword) {
    $_SESSION['errorMessage'] = 'Password And Re-tpe Password Does Not Match';
    return false;
  } else {
    return true;
  }
}

function addNewAdmin($con2)
{
  echo $_POST['username'] . $_POST['password'] . $_POST['confirm_password'] . '<br>';
  $time = time();
  $dateTime = strftime('%Y-%m-%d %H:%M:%S ', $time);
  $username = mysqli_real_escape_string($con2, $_POST['username']);
  $password = mysqli_real_escape_string($con2, $_POST['password']);
  $confirmPassword = mysqli_real_escape_string($con2, $_POST['confirm_password']);
  // $creator = $_SESSION['username'];
  echo $username . ' ' . $password . ' ' . $confirmPassword . '<br>';

  $validationResult = validateNewAdmin($username, $password, $confirmPassword);
  echo 'result: ' . $validationResult . '<br>';
  echo 'sessionError: ' . $_SESSION['errorMessage'] . '<br>';

  if ($validationResult) {
    // TODO: add email
    // TODO: add password hashing
    $result = addNewAdminQuery($username, 'sample-admin@test.ru', $password, 1, 2, $dateTime, $dateTime);
    echo 'add to db result: ' . $result . '<br>';
    if ($result) {
      $_SESSION['successMessage'] = 'New Admin Has Been Created Successfully';
      echo 'before success redirect <br>';
    } else {
      $_SESSION['errorMessage'] = 'Something Went Wrong Please Try Again Later';
      echo 'before failure redirect <br>';
    }
  }

  return true;
}

if (isset($_POST['submit'])) {
  $res = addNewAdmin($con2);
  if ($res) {
    Redirect_To('Admin.php');
  }
}
// TODO: refactor, old
if (isset($_GET['del_admin'])) {
  if (!empty($_GET['del_admin'])) {
    $sql = "DELETE FROM cms_admin WHERE id = '$_GET[del_admin]'";
    $exec = Query($sql);
    if ($exec) {
      $_SESSION['successMessage'] = 'Admin Deleted Successfully';
      mysqli_close($con);
      Redirect_To('Admin.php');

    } else {
      $_SESSION['errorMessage'] = 'Something Went Wrong Please Try Again Later';
      mysqli_close($con);
      Redirect_To('Admin.php');

    }
  }
}