<?php


function getQuoteAuthor($id) {
  $query = "SELECT * FROM Авторы WHERE id = $id";
  $exec = QueryNew($query);
  if ($post = mysqli_fetch_assoc($exec)) {
    return $post;
  }
  // $author = $resultArray[0];
  return null;
}

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
        $quote_auth_id = $post['автор'] ;
        $authorObj = getQuoteAuthor($quote_auth_id);
        $post_quote_author = $authorObj['фамилия'];
        
        $author_id = $post['автор_публикации'];
        $author_obj = getArticleAuthor($author_id);
        $post_author = $author_obj['никнейм'];

        $text = $post['текст'];
        $post_content = $text;
        if (strlen($text) > 350) {
          $post_content = substr($text, 0, 350) . '...';
        }




        ?>
        <div class="post" style="border: black solid 1px; border-radius: 5px; background-color: lightgrey;" >
          <div class="post-info">
            <p class="lead" style="color: darkblue;">
              Автор цитаты: <?php echo htmlentities($post_quote_author); ?>
            </p>
          </div>
          <div class="post-content" style="color: black;">
            <p class="lead"><?php echo nl2br($post_content); ?></p>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <div class="post-info">
              <p class="lead" style="color: darkblue; margin-bottom: 1px;">
                Публиковано: <?php echo htmlentities($post_date); ?> <br> Пользователь: <?php echo htmlentities($post_author); 
                ?> 
              </p>
            </div>
            <!-- <p> -->
              <a href="Post.php?id=<?php echo $post_id; ?>">
                <button style="" class="btn btn-info btn-lg" id="read_more_btn">Подробнее</button>
              </a>
              <!-- <div class="clearfix"></div> -->
            <!-- </p> -->
          </div>
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