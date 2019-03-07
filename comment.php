<?php require_once 'Include/Sessions.php';?>
<?php require_once 'Include/functions.php'?>
<?php require_once 'Include/dbFunctions.php'?>
<?php // TODO: закончить комментирование
if (isset($_POST['submit'])) {
  if (!empty($_POST['submit'])) {
    $postID = $_POST['id'];
    $author = $_POST['author'];
    $comment = $_POST['comment'];
    $time = time();
    $dateTime = strftime('%Y-%m-%d %H:%M:%S ', $time);

    echo 'post:' . $postID . '<br>';
    echo 'author_id:' . $author . '<br>';
    echo 'comment:' . $comment . '<br>';

    // TODO: write to db

    $sql = "INSERT INTO Комментарии 
      (автор, сообщение, статья, дата_публикации) 
      VALUES('$author', '$comment', '$postID', '$dateTime')";
    $exec = QueryNew($sql);
    if ($exec) {
      $_SESSION['successMessage'] = "Your Comment Has Been Submitted.";
      // mysqli_close($con);
    } else {
      $_SESSION['errorMessage'] = "Something Went Wrong Please Try Again Later";
    }
    Redirect_To("Post.php?id=$postID");
  }
}