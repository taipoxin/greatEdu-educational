<?php

function fillEditingBio()
{
  global $bio_id,
    $biography,
    $bio_author_surname,
    $bio_author_name,
    $bio_author_second_name,
    $bio_state,
    $bio_sphere,
    $bio_date,
    $bio_period,
    $bio_content,
    $bio_image;

  $bio_id = 'error';
  $bio_author_surname = 'фамилия';
  $bio_author_name = 'имя';
  $bio_author_second_name = 'отчество';
  $bio_state = 'error';
  $bio_sphere = 'error';
  $bio_period = 'error';
  $bio_content = 'error';
  $bio_image = 'error';

  if (isset($_GET['bio_id'])) {
    if (!empty($_GET['bio_id'])) {
      $sql = "SELECT * FROM Авторы WHERE id = '$_GET[bio_id]'";
      $exec = doSQLQuery($sql);
      if (mysqli_num_rows($exec) > 0) {
        if ($bio = mysqli_fetch_assoc($exec)) {

          $bio_id = $bio['id'];

          $bio_author_surname = "$bio[фамилия]";
          $bio_author_name = "$bio[имя]";
          $bio_author_second_name = "$bio[отчество]";

          $bio_state = $bio['страна_принадлежности'];

          $bio_sphere_id = $bio['сферы_деятельности'];
          $bio_sphere = getShpereNameById($bio_sphere_id);

          $bio_period_id = $bio['период'];
          $bio_period = getPeriodNameById($bio_period_id);

          $biography = $bio['биография'];
          $bio_image = $biography . '.jpg';

          $bio_content_file = $biography . '.txt';
          $bio_content = LoadTextFromBioFile($bio_content_file);
        }
      }
    }
  }
}

function handleUpdateBio()
{
  if (isset($_POST['bio-edit'])) {

    $update_bio_id = "$_POST[editID]";
    $update_bio_author_surname = $_POST['bio-author-surname'];
    $update_bio_author_name = $_POST['bio-author-name'];
    $update_bio_author_second_name = $_POST['bio-author-second-name'];
    $update_bio_state = $_POST['bio-state'];
    $update_bio_sphere_as_is = $_POST['bio-sphere'];
    $update_bio_period_as_is = $_POST['bio-period'];
    $update_bio_content = $_POST['bio-content'];

    $image = $_FILES['post-image']['name'];

    $_SESSION['errorMessage'] = 'post:'
      . $_POST['bio-author-surname'] . ' <br> '
      . $_POST['bio-author-name'] . ' <br>'
      . $_POST['bio-author-second-name'] . ' <br>'
      . $_POST['bio-state'] . ' <br>'
      . $_POST['bio-sphere'] . ' <br>'
      . $_POST['bio-period'] . ' <br>'
      . $_FILES['post-image']['name'] . ' <br>'
      . $_POST['currentImage'] . ' <br>'
      . $_POST['bio-content'] . ' <br>'
    ;

    if (!empty($image)) {
      $imgName = "bio$_POST[editID].jpg";
      $imageDirectory = "Upload/bios/" . $imgName;
      if (move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory)) {
        $_SESSION['successMessage'] = 'Updated Image';
      } else {
        $_SESSION['errorMessage'] = 'Something Went Wrong With saving image Please Try Again Later';
        return;
      }
    }

    $fileName = "bio$_POST[editID].txt";
    $textPath = "Upload/bios/" . $fileName;
    rewriteFileByPath($textPath, $update_bio_content);

    $sphere_id = getSphereIdByNameOrInsert($update_bio_sphere_as_is);
    $_SESSION['errorMessage'] = $_SESSION['errorMessage'] . " sphere: $sphere_id";

    $period_id = getPeriodIdByNameOrInsert($update_bio_period_as_is);
    $_SESSION['errorMessage'] = $_SESSION['errorMessage'] . " period: $period_id";

    $sql = "UPDATE Авторы SET
      фамилия = '$update_bio_author_surname',
      имя = '$update_bio_author_name',
      отчество = '$update_bio_author_second_name',
      страна_принадлежности = '$update_bio_state',
      сферы_деятельности = '$sphere_id',
      период = '$period_id'
      WHERE id = '$_POST[editID]' ";
    $exec = doSQLQuery($sql);
    if ($exec) {
      $_SESSION['errorMessage'] = null;
      $_SESSION['successMessage'] = $_SESSION['successMessage'] . ' | Post Edit Successfully:';
      Redirect_To('/Bios.php');
    } else {
      $_SESSION['errorMessage'] = $_SESSION['errorMessage'] . ' | Something Went Wrong With db write.';
    }

  }
}
