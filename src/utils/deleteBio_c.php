<?php

function fillDeletingBio()
{
  global $bio_id,
    $bio_author, 
    $bio_state,
    $bio_sphere,
    $bio_date,
    $bio_period,
    $bio_content,
    $bio_image;

  $bio_id = 'error';
  $bio_author = 'error';
  $bio_state = 'error';
  $bio_sphere = 'error';
  $bio_date = 'error';
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
          $bio_author = "$bio[фамилия] $bio[имя] $bio[отчество]";
          $bio_state = $bio['страна_принадлежности'];
          $bio_date = $bio['дата_добавления'];

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

function handleDeleteBio()
{
  if (isset($_POST['bio-delete'])) {
    $sql = "DELETE FROM Авторы WHERE id = '$_POST[deleteID]' ";
    $exec = doSQLQuery($sql);
    if ($exec) {
      $_SESSION['successMessage'] = "$_POST[deleteID] Quote Deleted Successfully";
      Redirect_To('/Bios.php');
    } else {
      $_SESSION['errorMessage'] = "Something Went Wrong, Quote Is Not Deleted. Please Try Again Later";
    }
  }
}
