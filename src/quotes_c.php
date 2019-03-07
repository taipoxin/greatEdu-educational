<?php


function fillQuotes() {
  global $con2;
  $page = 1;
  $query = "";
  if (isset($_GET['search'])) {
    if (empty($_GET['search'])) {
      Redirect_To('Blog.php');
    } else {
      // TODO: reformat search
      $search = $_GET['search'];
      $query = "SELECT * FROM cms_post WHERE post_date_time LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '$search%' ";
    }
  } else if (isset($_GET['category'])) {
    $query = "SELECT * FROM cms_post WHERE category = '$_GET[category]'";
  } else if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $showPost = ($page * 5) - 5;
    if ($page <= 0) {
      $showPost = 0;
    }
    $query = "SELECT * FROM Статьи ORDER BY дата_публикации DESC LIMIT $showPost,5	";

  } else {

    $query = "SELECT * FROM Цитаты ORDER BY дата_публикации DESC LIMIT 0,5	";
  }

  $exec = QueryNew($query) or die(mysqli_error($con2));
  if ($exec) {
    if (mysqli_num_rows($exec) > 0) {
      while ($post = mysqli_fetch_assoc($exec)) {
        $post_id = $post['id'];
        $post_date = $post['дата_публикации'];
        $post_title = 'заголовок';
        $post_quote_author = $post['автор'] ;
        
        $author_id = $post['автор_публикации'];
        $author_obj = getArticleAuthor($author_id);
        $post_author = $author_obj['никнейм'];

        $text = $post['текст'];
        $post_content = substr($text, 0, 200) . '...';


        ?>
        <div class="post">
          <div class="post-title">
            <h1><?php echo htmlentities($post_title); ?></h1>
          </div>
          <!-- <div class="thumbnail">
            <img class="img-responsive img-rounded" style="height: 100px;" 
            src="Upload/Image/19222724_1555772291131415_6272807584274196775_o.jpg">
          </div> -->
          <div class="post-info">
            <p class="lead">
              Публиковано: <?php echo htmlentities($post_date); ?> <br> Пользователь: <?php echo htmlentities($post_author); 
              ?> <br> Автор цитаты: <?php echo htmlentities($post_quote_author); ?>
            </p>
          </div>
          <div class="post-content">
            <p class="lead"><?php echo htmlentities($post_content); ?></p>
          </div>
          <p>
            <a href="Post.php?id=<?php echo $post_id; ?>">
              <button class="btn btn-info btn-lg" id="read_more_btn">Read More</button>
            </a>
            <div class="clearfix"></div>
          </p>
        </div>
  <?php
  }

  } else {
    echo "<span class='lead'>No result<span>";
    }
  } else {

  }

}

?>