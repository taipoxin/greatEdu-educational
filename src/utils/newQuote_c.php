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
  global $_POST, $_SESSION;
  if (isset($_POST['post-submit'])) {

    $title = $_POST['post-title'];
    $content = $_POST['post-content'];
    $image = $_FILES['post-image']['name'];
    
    $validationResult = validatePost($title, $content, $image);
    if (!$validationResult) {
      return;
    }

    $lastId = getLastArticleId();
    $post_id = $lastId + 1;

    $authorId =  $_SESSION['user_id'];
    $time = time();
    $dateTime = strftime('%Y-%m-%d %T', $time);

    $filename = "post_$post_id.txt";
    rewriteContentFile($filename, $content);

    if (!empty($image)) {
      $imageDirectory = "Upload/Image/" . basename($_FILES['post-image']['name']);
      if (move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory)) {
        $sql = "INSERT INTO Статьи (id, темы, автор, теги,
          дата_публикации, заголовок, файл_контент, изображение)
          VALUES ($post_id, 1, $authorId, 2,
          '$dateTime', '$title', '$filename', '$image')";
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

  }
}
