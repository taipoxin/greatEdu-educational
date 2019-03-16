<?php

function fillHeader()
{
  global $_GET, $title_title;
  $query = "SELECT заголовок FROM Статьи WHERE id = '$_GET[id]'";
  $exec = doSQLQuery($query);
  if (mysqli_num_rows($exec) > 0) {
    if ($post = mysqli_fetch_assoc($exec)) {
      $title_title = $post['заголовок'];
    }
  }

}

function fillPostData()
{
  global $_GET;
  if (isset($_GET['id'])) {
    $query = "SELECT * FROM Статьи WHERE id = '$_GET[id]'";
    $exec = doSQLQuery($query);
    $post_from_db = null;
    if (mysqli_num_rows($exec) > 0) {
      if ($post = mysqli_fetch_assoc($exec)) {
        $post_id = $post['id'];
        $post_date = $post['дата_публикации'];
        $post_title = $post['заголовок'];
        $post_themes = getThemesNamesByListId($post['темы']);
        $authorId = $post['автор'];
        $post_image = $post['изображение'];

        $post_from_db = $post['файл_контент'];

        $authObj = getUserById($authorId);
        $post_author = $authObj['никнейм'];

        $post_content = LoadTextFromContentFile($post_from_db);

        ?>
        <div class="post">
          <div class="post-title">
            <h1><?php echo htmlentities($post_title); ?></h1>
          </div>
          <div class="thumbnail">
            <img class="img-responsive img-rounded imagefull" style="max-height: 500px;" src="../Upload/Image/<?php echo $post_image . '?m=' . time(); ?>">
          </div>
          <div class="post-info">
            <p class="lead">
              Опубликовано: <?php echo htmlentities($post_date); ?> |
              Автор: <?php echo $post_author; ?>
            </p>
            <p class="lead">
              <?php  
                echo 'Темы: ' .  htmlentities(implode($post_themes, ', ')); 
              ?>
            </p>
          </div>
          <div class="post-content">
            <p class="lead"><?php echo nl2br($post_content); ?></p>
          </div>
        </div>
<?php
      }

    }
  } else {
    Redirect_To('Blog.php');
  }
}

function fillPostComments()
{
  $sql = "SELECT * FROM Комментарии WHERE статья = '$_GET[id]'";
  $exec = doSQLQuery($sql);
  if (mysqli_num_rows($exec) > 0) {
    while ($comments = mysqli_fetch_assoc($exec)) {
      $author_id = $comments['автор'];
      $auth = getUserById($author_id);
      $c_author = 'нераспознанный комментатор';
      if ($auth) {
        $c_author = $auth['никнейм'];
      }
      $c_dateTime = $comments['дата_публикации'];
      $c_comment = $comments['сообщение'];
      ?>

      <div class="comment-block" style="margin-bottom: 20px; ">
        <div class="row">
          <div class="col-sm-2" style="height: 70px;width: 100px; padding:0; margin:0;">
            <img style="height: inherit;width: inherit;" src="../Assets/Images/user-default.png">
          </div>
          <div class="col-sm-10">
            <div><span class="lead text-info"><?php echo $c_author; ?></span></div>
            <div><span><?php echo $c_dateTime; ?></span></div>
            <div><span class="lead"> Сказал: <?php echo $c_comment; ?></span></div>
          </div>
        </div>
      </div>

<?php
}
  } else {
    echo "Комментариев к статье нет";
  }
}

function fillPostsReferences()
{
  $sql = "SELECT * FROM Статьи ORDER BY дата_публикации DESC LIMIT 5 ";
  $exec = doSQLQuery($sql);
  while ($recentPost = mysqli_fetch_assoc($exec)) {
    $postID = $recentPost['id'];
    ?>
    <nav>
      <ul>
        <li><a href="Post.php?id=<?php echo $postID; ?>">
            <?php echo $recentPost['заголовок'] ?>
          </a></li>
      </ul>
    </nav>
  <?php
  }
}

function insertComment($author, $text, $postID, $dateTime)
{
  $sql = "INSERT INTO Комментарии
    (автор, сообщение, статья, дата_публикации)
    VALUES('$author', '$text', '$postID', '$dateTime')";
  return doSQLQuery($sql);
}

function handlePostAddComment()
{
  if (!empty($_POST['submit'])) {
    $postID = $_POST['id'];
    $author = $_POST['author'];
    $comment = $_POST['comment'];
    $time = time();
    $dateTime = strftime('%Y-%m-%d %H:%M:%S ', $time);

    $exec = insertComment($author, $comment, $postID, $dateTime);
    if ($exec) {
      $_SESSION['successMessage'] = "Your Comment Has Been Submitted.";
    } else {
      $_SESSION['errorMessage'] = "Something Went Wrong Please Try Again Later";
    }
    Redirect_To("Post.php?id=$postID");
  }
}

if (isset($_POST['submit'])) {
  handlePostAddComment();
}

?>