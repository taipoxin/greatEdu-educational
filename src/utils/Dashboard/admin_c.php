
<?php

function addNewAdminQuery($username, $email, $passwordHash, $status, $group, $dateOfRegister, $dateOfUpdate)
{
  $sql = "INSERT INTO Пользователи (никнейм, почта, хэш_пароля, статус, группа, дата_регистрации, дата_изменения)
      VALUES('$username', '$email', '$passwordHash', $status, $group, '$dateOfRegister', '$dateOfUpdate')";
  return doSQLQuery($sql);
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
  $email = mysqli_real_escape_string($con2, $_POST['email']);
  $password = mysqli_real_escape_string($con2, $_POST['password']);
  $confirmPassword = mysqli_real_escape_string($con2, $_POST['confirm_password']);

  $validationResult = validateNewAdmin($username, $password, $confirmPassword);

  if (!$validationResult) {
    return false;
  }
  if (empty($email)) {
    $_SESSION['errorMessage'] = 'Email cannot be empty';
    return false;
  }

  // TODO: add password hashing
  $result = addNewAdminQuery($username, $email, $password, 1, 2, $dateTime, $dateTime);
  if ($result) {
    $_SESSION['successMessage'] = 'New Admin Has Been Created Successfully';
  } else {
    $_SESSION['errorMessage'] = 'Something Went Wrong Please Try Again Later';
  }
  return true;
}

function getAllAdminsByChangeDesc()
{
  $viewSql = "SELECT * FROM Пользователи
    WHERE группа = 2
    ORDER BY дата_изменения DESC";
  return doSQLQuery($viewSql);
}

function retrieveAdmins()
{
  $num = 1;
  $exec = getAllAdminsByChangeDesc();
  while ($data = mysqli_fetch_assoc($exec)) {
    $id = $data['id'];
    $dateAdded = $data['дата_изменения'];
    $username = $data['никнейм'];
    echo "<tr>
        <td>$num</td>
        <td>$id</td>
        <td>$dateAdded</td>
        <td>$username</td>
        <td><a href='Admin.php?del_admin=$id'><button class='btn btn-danger'>Удалить</button></a></td>
      </tr>
    ";
    $num++;
  }
}

function deleteAdminById($id)
{
  $sql = "DELETE FROM Пользователи WHERE id = $id AND группа = 2";
  return doSQLQuery($sql);
}

// Add new admin
global $con2;
if (isset($_POST['submit'])) {
  $res = addNewAdmin($con2);
  if ($res) {
    Redirect_To('Admin.php');
  }
  else {
    Redirect_To('Admin.php');
  }
}
// Delete admin
if (isset($_GET['del_admin'])) {
  if (!empty($_GET['del_admin'])) {
    $exec = deleteAdminById($_GET['del_admin']);
    if ($exec) {
      $_SESSION['successMessage'] = 'Admin Deleted Successfully';
    } else {
      $_SESSION['errorMessage'] = 'Something Went Wrong Please Try Again Later';
    }
    Redirect_To('Admin.php');
  }
}
