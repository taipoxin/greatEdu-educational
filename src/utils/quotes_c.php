<?php


function getQuoteAuthor($id) {
  $query = "SELECT * FROM Авторы WHERE id = $id";
  $exec = doSQLQuery($query);
  if ($post = mysqli_fetch_assoc($exec)) {
    return $post;
  }
  // $author = $resultArray[0];
  return null;
}

function fillQuotes() {
  global $con2;
  if (!isset($_GET['page'])) {
    $page = 1;
  }
  // $page = 1;
  $query = "";
  if (isset($_GET['search'])) {
    if (empty($_GET['search'])) {
      Redirect_To('Blog.php');
    } else {
      // TODO: reformat search
      // $search = $_GET['search'];
      // $query = "SELECT * FROM Цитаты WHERE дата_публикации LIKE '%$search%' OR автор LIKE '%$search%' OR автор_публикации LIKE '$search%'";
    }
  } else if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $showPost = ($page * 5) - 5;
    if ($page <= 0) {
      $showPost = 0;
    }
    $query = "SELECT * FROM Цитаты ORDER BY дата_публикации DESC LIMIT $showPost,5	";

  } else {

    $query = "SELECT * FROM Цитаты ORDER BY дата_публикации DESC LIMIT 0,5	";
  }

  $exec = doSQLQuery($query) or die(mysqli_error($con2));
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
        $author_obj = getUserById($author_id);
        $post_author = $author_obj['никнейм'];

        $text = $post['текст'];
        $post_content = $text;
        if (mb_strlen($text) > 300) {
          $post_content = mb_substr($text, 0, 300, "utf-8") . '...';
        }

        ?>
        <div class="post" style="border: black solid 1px; border-radius: 5px; background-color: lightgrey;" >
        <div style="display: flex; justify-content: space-between;">  
          <div class="post-info">
            <p class="lead" style="color: darkblue;">
              Автор цитаты: 
              <a href="/Bio.php?id=<?php echo $author_id?>">
                <?php echo htmlentities($post_quote_author); ?>
              </a>
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
            <a href="Quote.php?id=<?php echo $post_id; ?>">
              <button style="width: 128px;" class="btn btn-info btn-lg" id="read_more_btn">Подробнее</button>
            </a>
          </div>
        </div>
  <?php
  }

  } else {
    echo "<span class='lead'>Нет никаких цитат<span>";
    }
  } else {
    echo "<span class='lead'>Ошибка сервера<span>";
  }

}


function fillPagesQuotes() {
  if (!isset($_GET['page'])) {
    $page = 1;
  }
  else {
    $page = $_GET['page'];
  }
  if ($page > 1) {
    ?>
    <li><a href="Quotes.php?page=<?php echo $page - 1; ?>"><</a></li>
    <?php
  }
  $sql = "SELECT COUNT(*) FROM Цитаты";
  $exec = doSQLQuery($sql);
  $rowCount = mysqli_fetch_array($exec);
  if (!$rowCount) {return;}
  $totalRow = array_shift($rowCount);
  $postPerPage = ceil($totalRow / 5);

  for ($count = 1; $count <= $postPerPage; $count++){
    if ($page == $count) {
      ?>
      <li class="active"><a href="Quotes.php?page=<?php echo $count ?>"><?php echo $count ?></a></li>
      <?php
    }else {
      ?>
      <li><a href="Quotes.php?page=<?php echo $count ?>"><?php echo $count ?></a></li>
      <?php
    }
  }
  if($page < $postPerPage) {
    ?>
    <li><a href="Quotes.php?page=<?php echo $page + 1; ?>">></a></li>
    <?php
  }
  
}


function fillQuotesReferences()
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