<?php

function fillHeader()
{
  global $_GET, $title_title;
  $query = "SELECT фамилия, имя, отчество FROM Авторы WHERE id = '$_GET[id]'";
  $exec = doSQLQuery($query);
  if (mysqli_num_rows($exec) > 0) {
    if ($post = mysqli_fetch_assoc($exec)) {
      $title_title = "$post[фамилия] $post[имя] $post[отчество]";
    }
  }
}



function fillBioData()
{
  global $_GET;
  if (isset($_GET['id'])) {
    $query = "SELECT * FROM Авторы WHERE id = '$_GET[id]'";
    $exec = doSQLQuery($query);
    if (mysqli_num_rows($exec) > 0) {
      if ($post = mysqli_fetch_assoc($exec)) {
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
        $post_content = LoadTextFromBioFile($post_file);

        ?>
        <div class="post">
          <div class="post-title">
            <h1><?php echo htmlentities($post_title); ?></h1>
          </div>
          <div class="thumbnail">
            <img class="img-responsive img-rounded" style="max-height: 500px;" src="../Upload/bios/<?php echo $post_image . '?m='; ?>">
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
        </div>
    <?php
      }

    }
  } else {
    Redirect_To('/Bios.php');
  }
}

function fillBioReferences()
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