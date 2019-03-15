<?php


function fillBios() {
  global $con2;
  // global $page;
  if (!isset($_GET['page'])) {
    $page = 1;
  }
  $query = "";
  if (isset($_GET['search'])) {
    if (empty($_GET['search'])) {
      Redirect_To('Blog.php');
    } else {
      // TODO: reformat search
      // $search = $_GET['search'];
      // $query = "SELECT * FROM cms_post WHERE post_date_time LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '$search%' ";
    }
  } else if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $showPost = ($page * 5) - 5;
    if ($page <= 0) {
      $showPost = 0;
    }
    $query = "SELECT * FROM Авторы ORDER BY дата_добавления DESC LIMIT $showPost,5	";

  } else {
    $query = "SELECT * FROM Авторы ORDER BY дата_добавления DESC LIMIT 0,5	";
  }

  $exec = doSQLQuery($query) or die(mysqli_error($con2));
  if ($exec) {
    if (mysqli_num_rows($exec) > 0) {
      while ($post = mysqli_fetch_assoc($exec)) {
        $post_id = $post['id'];
        $post_date = $post['дата_добавления'];
        $post_title = "$post[фамилия] $post[имя] $post[отчество]";

        $post_state = $post['страна_принадлежности'];
        $post_sphere_id = $post['сферы_деятельности'];
        $post_sphere = getShpereNameById($post_sphere_id);

        $post_period_id = $post['период'];
        $post_period = getPeriodNameById($post_period_id);

        $biography = $post['биография'];


        $post_image = $biography . '.jpg';
        $post_file = $biography . '.txt';
        $text = LoadTextFromBioFile($post_file);
        $post_content = $text;
        if (mb_strlen($text) > 128) {
          $post_content = mb_substr($text, 0, 128, "utf-8") . '...';
        }

        ?>
        <div class="post">
          <div class="post-title">
            <h1><?php echo htmlentities($post_title); ?></h1>
          </div>
          <div class="thumbnail">
            <img class="img-responsive img-rounded" src="../Upload/bios/<?php echo $post_image . '?m='. time(); ?>">
          </div>
          <div class="post-info">
          <p class="lead">
              Опубликовано: <?php echo htmlentities($post_date); ?> | Период: <?php echo htmlentities($post_period); ?> |
              Страна: <?php echo $post_state; ?> | Сферы деятельности: <?php echo $post_sphere; ?> 
            </p>
          </div>
          <div class="post-content">
            <p class="lead"><?php echo nl2br($post_content); ?></p>
          </div>
          <p>
            <?php global $isAdmined; ?>
            <?php if($isAdmined) : ?>

            <a href="editBio.php?bio_id=<?php echo $post_id; ?>">
              <button style="" class="btn btn-warning btn-lg">Изменить</button>
            </a>
            <a href="deleteBio.php?bio_id=<?php echo $post_id; ?>">
              <button style="" class="btn btn-danger btn-lg">Удалить</button>
            </a>
            
            <?php endif; ?>
            <a href="Bio.php?id=<?php echo $post_id; ?>">
              <button class="btn btn-info btn-lg" id="read_more_btn">Подробнее</button>
            </a>
            <div class="clearfix"></div>
          </p>
        </div>
      <?php
      }

    } else {
      echo "<span class='lead'>No result<span>";
    }
  }
}

function fillPages() {
  if (!isset($_GET['page'])) {
    $page = 1;
  }
  else {
    $page = $_GET['page'];
  }
  if ($page > 1) {
    ?>
    <li><a href="/Bios.php?page=<?php echo $page - 1; ?>"><</a></li>
    <?php
  }
  $sql = "SELECT COUNT(*) FROM Авторы";
  $exec = doSQLQuery($sql);
  $rowCount = mysqli_fetch_array($exec);
  if (!$rowCount) {return;}
  $totalRow = array_shift($rowCount);
  $postPerPage = ceil($totalRow / 5);

  for ($count = 1; $count <= $postPerPage; $count++){
    if ($page == $count) {
      ?>
      <li class="active"><a href="/Bios.php?page=<?php echo $count ?>"><?php echo $count ?></a></li>
      <?php
    }else {
      ?>
      <li><a href="/Bios.php?page=<?php echo $count ?>"><?php echo $count ?></a></li>
      <?php
    }
  }
  if($page < $postPerPage) {
    ?>
    <li><a href="/Bios.php?page=<?php echo $page + 1; ?>">></a></li>
    <?php
  }
  
}



function fillBiosReferences()
{
  $sql = "SELECT * FROM Авторы ORDER BY дата_добавления DESC LIMIT 5 ";
  $exec = doSQLQuery($sql);
  while ($recentPost = mysqli_fetch_assoc($exec)) {
    $postID = $recentPost['id'];
    $linkText = "$recentPost[фамилия] $recentPost[имя] $recentPost[отчество]";
    ?>
    <nav>
      <ul>
        <li><a href="/Bio.php?id=<?php echo $postID; ?>">
            <?php echo $linkText ?>
          </a></li>
      </ul>
    </nav>
  <?php
  }
}


?>