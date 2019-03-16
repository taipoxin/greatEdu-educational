<?php

function fillArticleTable()
{

  $sql = "SELECT * FROM Статьи ORDER BY дата_публикации";
  $exec = doSQLQuery($sql);
  $postNo = 1;
  if (mysqli_num_rows($exec) < 1) {
    ?>
    <p class="lead">У вас 0 постов в данный момент</p>
    <a href="NewPost.php"><button class="btn btn-info">Добавить пост</button></a>
    <?php
  } else {?>
      <table class="table table-hover">
        <tr>
          <th>Id</th>
          <th>Дата публикации</th>
          <th>Заголовок</th>
          <th>Автор</th>
          <th>Изображение</th>
          <th>Действия</th>
          <th>Детали</th>
        </tr>
        <?php
    while ($post = mysqli_fetch_assoc($exec)) {
      $post_id = $post['id'];
      $post_date = $post['дата_публикации'];
      $post_title = $post['заголовок'];
      $authorId = $post['автор'];
      $author = getUserById($authorId)['никнейм'];

      $image = $post['изображение'];
      ?>
      <tr>
        <td><?php echo $post_id; ?></td>
        <td><?php echo $post_date; ?></td>
        <td><?php
      if (mb_strlen($post_title) > 32) {
        echo mb_substr($post_title, 0, 32, "utf-8") . '...';
      } else {
        echo $post_title;
      }
      $t = time();
      ?></td>
        <td><?php echo $author; ?></td>
        <td>
          <?php echo "<img class='img-responsive' src='../Upload/Image/$image?m=$t' width='100px' height='150px'>"; ?>
        </td>
        <td>
          <?php echo "<a href='editpost.php?post_id=$post_id'>Изменить</a> | <a href='deletepost.php?delete_post_id=$post_id'>Удалить</a>"; ?>
        </td>
        <td><a href="/Article.php?id=<?php echo $post_id; ?>"><button class="btn btn-primary">Просмотреть</button></a></td>
      </tr>
      <?php
      $postNo++;
    }
  }
}

?>