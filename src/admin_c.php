<?php require_once('Include/Sessions.php'); ?>
<?php require_once('Include/functions.php') ?>
<?php require_once('Include/dbFunctions.php') ?>
<?php require_once('Include/fileFunctions.php') ?>

<?php // TODO: everything old

function addNewAdminQuery($username, $email, $passwordHash, $status, $group, $dateOfRegister, $dateOfUpdate)
{
    $sql = "INSERT INTO Пользователи (никнейм, почта, хэш_пароля, статус, группа, дата_регистрации, дата_изменения)
      VALUES('$username', '$email', '$passwordHash', $status, $group, '$dateOfRegister', '$dateOfUpdate')";
    return QueryNew($sql);
}

function validateNewAdmin($username, $password, $confirmPassword) {
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $_SESSION['errorMessage'] = "All Fields Must Be Fill Out $username, $password, $confirmPassword";
        Redirect_To('Admin.php');
    } else if (strlen($password) < 2) {
        $_SESSION['errorMessage'] = 'Password Must Be 2 Or More Characters';
        Redirect_To('Admin.php');
    } else if ($password !== $confirmPassword) {
        $_SESSION['errorMessage'] = 'Password And Re-tpe Password Does Not Match';
        Redirect_To('Admin.php');
    }
    else {
        return true;
    }
}

function addNewAdmin()
{
    echo $_POST['username'] . $_POST['password'] . $_POST['confirm_password'];
    return;
    $time = time();
    $dateTime = strftime('%Y-%m-%d %H:%M:%S ', $time);
    $username = mysqli_real_escape_string($con2, $_POST['username']);
    $password = mysqli_real_escape_string($con2, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con2, $_POST['confirm_password']);
    $creator = $_SESSION['username'];

    
    if (validateNewAdmin($username, $password, $confirmPassword)) {
        // TODO: add email
        // TODO: add password hashing
        // $sql = "INSERT INTO cms_admin (date_time, username, password, added_by) VALUES('$dateTime', '$username', '$password', '$creator')";
        $result = addNewAdmin($username, 'sample-admin@test.ru', $password, 1, 2, $dateTime, $dateTime);
        if ($result) {
            $_SESSION['successMessage'] = 'New Admin Has Been Created Successfully';
            // mysqli_close($con2);
            Redirect_To('Admin.php');
        } else {
            $_SESSION['errorMessage'] = 'Something Went Wrong Please Try Again Later';
            Redirect_To('Admin.php');
        }
    }
    
}

if (isset($_POST['submit'])) {
    // date_default_timezone_set('Asia/Manila');
    addNewAdmin();
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
