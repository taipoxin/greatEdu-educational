<?php
function LoginAttempt($username, $password)
{
  $query = "SELECT id, никнейм, группа FROM `Пользователи` WHERE `никнейм` = '$username'  AND `хэш_пароля` = '$password'";
  $exec = doSQLQuery($query);
  // Tables_in_great_edu
  if ($user = mysqli_fetch_assoc($exec)) {
    return $user;
  } else {
    return null;
  }
}



if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if (empty($username) || empty($password)) {
    $_SESSION['errorMessage'] = 'All Fields Must Be Fill Out';
  } else {
    $foundAccount = LoginAttempt($username, $password);
    if ($foundAccount) {

      // $_SESSION['errorMessage'] = $foundAccount;
      $_SESSION['successMessage'] = 'Login Successfully Welcome ' . $foundAccount['никнейм'];
      $_SESSION['user_id'] = $foundAccount['id'];
      $_SESSION['username'] = $foundAccount['никнейм'];
      // если админ
      if ($foundAccount['группа'] == '2') {
        Redirect_To('Dashboard');
      } else {
        Redirect_To('/');
      }
    } else {
      $_SESSION['errorMessage'] = 'Username/Password Is Invalid';
    }
  }
}
