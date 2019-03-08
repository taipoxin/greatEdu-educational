<?php

// TODO: old, should be refactored
function handleNewPost()
{
  global $con2;
  // date_default_timezone_set('Asia/Manila');
  $time = time();
  if (isset($_POST['post-submit'])) {
    $title = mysqli_real_escape_string($con2, $_POST['post-title']);
    $category = mysqli_real_escape_string($con2, $_POST['post-category']);
    $content = mysqli_real_escape_string($con2, $_POST['post-content']);
    $image = $_FILES['post-image']['name'];
    $author = $_SESSION['username'];
    $dateTime = strftime('%Y-%m-%d', $time);
    $title_length = strlen($title);
    $content_lenght = strlen($content);
    $imageDirectory = "../Upload/Image/" . basename($_FILES['post-image']['name']);
    if (empty($title)) {
      $_SESSION['errorMessage'] = "Title Is Emtpy";
      Redirect_To('NewPost.php');
    } else if ($title_length > 50) {
      $_SESSION['errorMessage'] = "Title Is Too Long";
      Redirect_To('NewPost.php');
    } else if (empty($content)) {
      $_SESSION['errorMessage'] = "Content Is Empty";
      Redirect_To('NewPost.php');
    } else if ($content_lenght > 4000) {
      $_SESSION['errorMessage'] = "Content Is Too Long";
      Redirect_To('NewPost.php');
    } else {
      $query = "INSERT INTO cms_post (post_date_time, title, category, author, image, post)
      VALUES ('$dateTime', '$title', '$category', '$author', '$image', '$content')";
      $exec = Query($query);
      if ($exec) {
        move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory);
        $_SESSION['successMessage'] = "Post Added Successfully";
      } else {
        $_SESSION['errorMessage'] = "Something Went Wrong Please Try Again";

      }

    }
  }
}
