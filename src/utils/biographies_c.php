<?php

function fillBiographiesTable()
{

  $sql = "SELECT * FROM Авторы ORDER BY дата_добавления";
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
          <th>ФИО</th>
          <th>Страна принадлежности</th>
          <th>Сферы Деятельности</th>
          <th>Период</th>
          <th>Изображение</th>
          <th>Действия</th>
          <th>Детали</th>
        </tr>
        <?php
    while ($post = mysqli_fetch_assoc($exec)) {
      $bio_id = $post['id'];
      $post_date = $post['дата_добавления'];
      $state = $post['страна_принадлежности'];
      $spheres = $post['сферы_деятельности'];
      $period = $post['период'];
      // $post_title = $post['заголовок'];
      $post_fullname = "$post[фамилия]  $post[имя] $post[отчество]"; 

      $biography = $post['биография'];
      $image = $biography . '.jpg';
      $t = time();
      ?>
      <tr>
        <td><?php echo $bio_id; ?></td>
        <td><?php echo $post_date; ?></td>
        <td><?php echo $post_fullname;?></td>
        <td><?php echo $state;?></td>
        <td><?php echo $spheres;?></td>
        <td><?php echo $period;?></td>
        <td>
          <?php echo "<img class='img-responsive' src='../Upload/bios/$image?m=$t' width='100px' height='150px'>"; ?>
        </td>
        <td>
          <?php echo "<a href='/editBio.php?bio_id=$bio_id'>Изменить</a> | <a href='/deleteBio.php?bio_id=$bio_id'>Удалить</a>"; ?>
        </td>
        <td><a href="/Bio.php?id=<?php echo $bio_id; ?>"><button class="btn btn-primary">Просмотреть</button></a></td>
      </tr>
      <?php // TODO: old editpost, deletepost
      $postNo++;
    }
  }
}

?>