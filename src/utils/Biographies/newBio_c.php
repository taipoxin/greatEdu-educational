<?php

function getLastBioId()
{
  $sql = "SELECT MAX(id) as 'max_id' FROM Авторы";
  $exec = doSQLQuery($sql);
  if ($data = mysqli_fetch_assoc($exec)) {
    return $data['max_id'];
  }
  return null;
}

function handleUpdateBio()
{
  if (isset($_POST['bio-insert'])) {

    $lastId = getLastBioId();
    if (is_null($lastId)) {
      $_SESSION['errorMessage'] = 'No any bios';
      $lastId = 0;
    }
    $update_bio_id = $lastId + 1;
    $update_bio_biography = "bio$update_bio_id";

    $update_bio_author_surname = $_POST['bio-author-surname'];
    $update_bio_author_name = $_POST['bio-author-name'];
    $update_bio_author_second_name = $_POST['bio-author-second-name'];
    $update_bio_state = $_POST['bio-state'];
    $update_bio_sphere_as_is = $_POST['bio-sphere'];
    $update_bio_period_as_is = $_POST['bio-period'];
    $update_bio_content = $_POST['bio-content'];

    $image = $_FILES['post-image']['name'];

    $_SESSION['errorMessage'] = 'post: '
      . $update_bio_id . ' <br> '
      . $update_bio_biography . ' <br> '
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
      $imgName = "$update_bio_biography.jpg";
      $imageDirectory = "../Upload/bios/" . $imgName;
      if (move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory)) {
        $_SESSION['successMessage'] = 'Updated Image';
      } else {
        $_SESSION['errorMessage'] = 'Something Went Wrong With saving image Please Try Again Later';
        return;
      }
    } else {
      $_SESSION['errorMessage'] = $_SESSION['errorMessage'] . 'image not chosen';
      return;
    }

    $fileName = "$update_bio_biography.txt";
    $textPath = "../Upload/bios/" . $fileName;
    rewriteFileByPath($textPath, $update_bio_content);

    $sphere_id = getSphereIdByNameOrInsert($update_bio_sphere_as_is);
    $_SESSION['errorMessage'] = $_SESSION['errorMessage'] . " sphere: $sphere_id";

    $period_id = getPeriodIdByNameOrInsert($update_bio_period_as_is);
    $_SESSION['errorMessage'] = $_SESSION['errorMessage'] . " period: $period_id";

    $time = time();
    $dateTime = strftime('%Y-%m-%d %T', $time);

    $sql = "INSERT INTO Авторы
      (id, фамилия, имя, отчество, страна_принадлежности,
      сферы_деятельности, период, биография, дата_добавления)
      VALUES (
      '$update_bio_id',
      '$update_bio_author_surname',
      '$update_bio_author_name',
      '$update_bio_author_second_name',
      '$update_bio_state',
      '$sphere_id',
      '$period_id',
      '$update_bio_biography',
      '$dateTime')";

    // $_SESSION['errorMessage'] = $sql;
    // return;

    $exec = doSQLQuery($sql);
    if ($exec) {
      $_SESSION['errorMessage'] = null;
      $_SESSION['successMessage'] = $_SESSION['successMessage'] . " | Bio $update_bio_id Added Successfully:";
      Redirect_To('Bios.php');
    } else {
      $_SESSION['errorMessage'] = $_SESSION['errorMessage'] . ' | Something Went Wrong With db write.';
    }

  }
}
