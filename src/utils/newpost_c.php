<?php

function getLastArticleId()
{
  $sql = "SELECT MAX(id) as 'max_id' FROM Статьи";
  $exec = doSQLQuery($sql);
  if ($data = mysqli_fetch_assoc($exec)) {
    return $data['max_id'];
  }
  return null;
}

function handleNewPost()
{
  global $con2, $_POST, $_SESSION;
  if (isset($_POST['post-submit'])) {

    $time = time();
    $title = $_POST['post-title'];

    $image = $_FILES['post-image']['name'];
    // $author = $_SESSION['username'];
    $dateTime = strftime('%Y-%m-%d %T', $time);
    // $title_length = strlen($title);

    $content = $_POST['post-content'];
    // $content_lenght = strlen($content);

    $lastId = getLastArticleId();
    $post_id = $lastId + 1;
    $authorId =  $_SESSION['user_id'];

    $filename = "post_$post_id.txt";
    rewriteContentFile($filename, $content);

    if (!empty($image)) {
      $imageDirectory = "Upload/Image/" . basename($_FILES['post-image']['name']);
      if (move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory)) {
        $sql = "INSERT INTO Статьи (id, темы, автор, теги,
          дата_публикации, заголовок, файл_контент, изображение)
          VALUES ($post_id, 1, $authorId, 2,
          '$dateTime', '$title', '$filename', '$image')";
        // $_SESSION['errorMessage'] = "$sql";
        $exec = doSQLQuery($sql);
        if ($exec) {
          $_SESSION['successMessage'] = 'Post Added Successfully';
        }
        else {
          $_SESSION['errorMessage'] = 'Something wrong with insert to db';
        }
        
      } else {
        $_SESSION['errorMessage'] = 'Something Went Wrong With saving image Please Try Again Later';
      }
    }
    else {
      $_SESSION['errorMessage'] = 'You do not set image for article';
    }
    

    // $imageDirectory = "../Upload/Image/" . basename($_FILES['post-image']['name']);
    // if (empty($title)) {
    //   $_SESSION['errorMessage'] = "Title Is Emtpy";
    //   Redirect_To('NewPost.php');
    // } else if ($title_length > 50) {
    //   $_SESSION['errorMessage'] = "Title Is Too Long";
    //   Redirect_To('NewPost.php');
    // } else if (empty($content)) {
    //   $_SESSION['errorMessage'] = "Content Is Empty";
    //   Redirect_To('NewPost.php');
    // } else if ($content_lenght > 4000) {
    //   $_SESSION['errorMessage'] = "Content Is Too Long";
    //   Redirect_To('NewPost.php');
    // } else {
    //   $query = "INSERT INTO cms_post (post_date_time, title, category, author, image, post)
    //   VALUES ('$dateTime', '$title', '$category', '$author', '$image', '$content')";
    //   $exec = Query($query);
    //   if ($exec) {
    //     move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory);
    //     $_SESSION['successMessage'] = "Post Added Successfully";
    //   } else {
    //     $_SESSION['errorMessage'] = "Something Went Wrong Please Try Again";

    //   }

  }
}
