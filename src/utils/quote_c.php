<?php

function getQuotePageTitle()
{
  global $_GET;
  return 'Цитата #' . $_GET['id'] . ' - GreatEdu';
}


function getQuoteAuthor($id) {
  $query = "SELECT * FROM Авторы WHERE id = $id";
  $exec = doSQLQuery($query);
  if ($post = mysqli_fetch_assoc($exec)) {
    return $post;
  }
  return null;
}

function fillQuoteData() {
  global $con2;
  $query = "SELECT * FROM Цитаты WHERE id = '$_GET[id]'	";

  $exec = doSQLQuery($query) or die(mysqli_error($con2));
  if ($exec) {
    if (mysqli_num_rows($exec) > 0) {
      if ($post = mysqli_fetch_assoc($exec)) {
        $post_id = $post['id'];
        $post_date = $post['дата_публикации'];
        $post_title = 'заголовок';
        $quote_auth_id = $post['автор'] ;
        $authorObj = getQuoteAuthor($quote_auth_id);
        $post_quote_author = $authorObj['фамилия'];
        
        $author_id = $post['автор_публикации'];
        $author_obj = getUserById($author_id);
        $post_author = $author_obj['никнейм'];

        $text = $post['текст'];
        $post_content = $text;

        ?>
        <div class="post" style="border: black solid 1px; border-radius: 5px; background-color: lightgrey;" >
        <div style="display: flex; justify-content: space-between;">  
          <div class="post-info">
            <p class="lead" style="color: darkblue;">
              Автор цитаты: <?php echo htmlentities($post_quote_author); ?>
            </p>
          </div>
          <?php global $isAdmined; if($isAdmined) : ?>
            <a href="deleteQuote.php?quote_id=<?php echo $post_id; ?>">
              <button style="width: 128px;" class="btn btn-danger btn-lg" id="read_more_btn">Удалить</button>
            </a>
          <?php endif; ?>
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
          </div>
        </div>
  <?php
  }
  } else {
    echo "<span class='lead'>Ошибка: нет цитаты с таким id<span>";
    }
  } else {
    echo "<span class='lead'>Ошибка сервера<span>";
  }

}


function fillPostComments()
{
  $sql = "SELECT * FROM Комментарии WHERE статья = '$_GET[id]'";
  $exec = doSQLQuery($sql);
  if (mysqli_num_rows($exec) > 0) {
    while ($comments = mysqli_fetch_assoc($exec)) {
      $c_email = 'комментатор';
      $c_dateTime = '14-02-19 21:00';
      $c_comment = $comments['сообщение'];
      ?>

      <div class="comment-block" style="margin-bottom: 20px; ">
        <div class="row">
          <div class="col-sm-2" style="height: 70px;width: 100px; padding:0; margin:0;">
            <img src="../js-scripts/Assets/Images/user-default.png">
          </div>
          <div class="col-sm-10">
            <div><span class="lead text-info"><?php echo $c_email; ?></span></div>
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

function fillQuoteReferences()
{
  $sql = "SELECT * FROM Цитаты ORDER BY дата_публикации DESC LIMIT 5 ";
  $exec = doSQLQuery($sql);
  while ($recentPost = mysqli_fetch_assoc($exec)) {
    $postID = $recentPost['id'];
    $text = $recentPost['текст'];
    if (mb_strlen($text) > 32) {
      $text = mb_substr($text, 0, 32, "utf-8") . '...';
    }
    ?>
    <nav>
      <ul>
        <li><a href="Quote.php?id=<?php echo $postID; ?>">
            <?php echo $text ?>
          </a></li>
      </ul>
    </nav>
  <?php
  }
}

?>