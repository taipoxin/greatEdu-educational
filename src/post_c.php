<?php

function fillHeader()
{
  global $_GET, $title_title;
  $query = "SELECT заголовок FROM Статьи WHERE id = '$_GET[id]'";
  $exec = QueryNew($query);
  if (mysqli_num_rows($exec) > 0) {
    while ($post = mysqli_fetch_assoc($exec)) {
      $title_title = $post['заголовок'];
    }
  }

}

function fillPostData()
{
  if (isset($_GET['id'])) {
    $query = "SELECT * FROM Статьи WHERE id = '$_GET[id]'";
    $exec = QueryNew($query);
    $post_from_db = null;
    if (mysqli_num_rows($exec) > 0) {
      while ($post = mysqli_fetch_assoc($exec)) {
        $post_id = $post['id'];
        $post_date = '00 00 date';
        $post_title = $post['заголовок'];
        $post_category = 'категория';
        $post_author = 'автор';
        $post_image = $post['изображение'];
        // $post_content = $post['post'];
        $post_from_db = $post['файл_контент'];
      }
      $post_content = LoadText($post_from_db);

      ?>
      <div class="post">
        <div class="post-title">
          <h1><?php echo htmlentities($post_title); ?></h1>
        </div>
        <div class="thumbnail">
          <img class="img-responsive img-rounded" style="max-height: 500px;" src="Upload/Image/<?php echo $post_image; ?>">
        </div>
        <div class="post-info">
          <p class="lead">
            Published on: <?php echo htmlentities($post_date); ?> | Category: <?php echo htmlentities($post_category); ?> |
            By: <?php echo $post_author; ?>
          </p>
        </div>
        <div class="post-content">
          <p class="lead"><?php echo nl2br($post_content); ?></p>
        </div>
      </div>
<?php

    }
  } else {
    Redirect_To('Blog.php');
  }
}

function fillPostComments()
{
  // $sql = "SELECT * FROM comment WHERE post_id = '$_GET[id]'";
  $sql = "SELECT * FROM Комментарии WHERE статья = '$_GET[id]'";
  $exec = QueryNew($sql);
  if (mysqli_num_rows($exec) > 0) {
    while ($comments = mysqli_fetch_assoc($exec)) {
      // $c_email = $comments['email'];
      $c_email = 'комментатор';
      // $c_dateTime = $comments['date_time'];
      $c_dateTime = '14-02-19 21:00';
      // $c_comment = $comments['comment'];
      $c_comment = $comments['сообщение'];
      ?>

      <div class="comment-block" style="margin-bottom: 20px; ">
        <div class="row">
          <div class="col-sm-2" style="height: 70px;width: 100px; padding:0; margin:0;">
            <img src="public/Assets/Images/user-default.png" height="70px" width="100px">
          </div>
          <div class="col-sm-10">
            <div><span class="lead text-info"><?php echo $c_email; ?></span></div>
            <div><span><?php echo $c_dateTime; ?></span></div>
            <div><span class="lead"> Say: <?php echo $c_comment; ?></span></div>
          </div>
        </div>
      </div>

<?php
}
  } else {
    echo "No Comments Yet";
  }
}

function fillPostsReferences()
{
  $sql = "SELECT * FROM Статьи LIMIT 5";
  $exec = QueryNew($sql);
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

?>