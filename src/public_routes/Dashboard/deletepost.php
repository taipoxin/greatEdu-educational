<?php require_once('../../Include/Sessions.php'); ?>
<?php require_once('../../Include/commonFuncs.php') ?>
<?php require_once('../../Include/dbFunctions.php') ?>

<?php require_once('../../utils/deletepost_c.php') ?>
<?php loginRequired(); ?>
<?php 
global $post_title, $post_image, $post_content;
?>

<!DOCTYPE html>
<html>

<head>
  <title>Удалить статью - Панель управления GreatEdu</title>
  <script src="../../js-scripts/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../../js-scripts/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../js-scripts/Assets/style.css">
  <script type="text/javascript" src="../../js-scripts/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="heading">
    <a href="">
      <p>Панель управления</p>
    </a>
  </div>
  <div class="container-fluid">
    <div class="main">
      <div class="row">
        <div class="col-sm-2">
          <ul id="side-menu" class="nav nav-pills nav-stacked">
            <li class=""><a href="Dashboard.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Статьи</a></li>
            <li class=""><a href="NewPost.php">
                <span class="glyphicon glyphicon-list"></span>
                &nbsp;Новая статья</a></li>
            <li><a href="Admin.php">
                <span class="glyphicon glyphicon-user"></span>
                &nbsp;Администраторы</a></li>
            <li><a href="/Blog.php">
                <span class="glyphicon glyphicon-equalizer"></span>
                &nbsp;На главную</a></li>
            <li><a href="/Lagout.php">
                <span class="glyphicon glyphicon-log-out"></span>
                &nbsp;Выйти</a></li>
          </ul>
        </div>
        <div class="col-xs-10">
          <div class="page-title">
            <h1>Удалить статью</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <form action="deletepost.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <button name="post-delete" class="btn btn-danger form-control">УДАЛИТЬ</button>
              </div>
              <div class="form-group">
                <p for="post-title">Заголовок</p>
                <input disabled type="text" name="post-title" class="form-control" id="post-title"
                  value="<?php echo $post_title ?>">
              </div>
              <label>Изображение: <img src="../../Upload/Image/<?php echo $post_image . '?m=';  ?>" width='250' height='90'>
              </label>
              <div class="form-group">
                <p for="post-image">Изменить изображение</p>
                <input disabled type="File" name="post-image" class="form-control">
              </div>
              <div class="form-group">
                <p for="post-content">Текст (поддерживает HTML)</p>
                <textarea disabled rows="20" class="form-control" name="post-content"
                  id="post-content"><?php echo htmlentities($post_content); ?></textarea>
              </div>
              <input type="hidden" name="deleteID" value="<?php echo $_GET['delete_post_id']; ?>">
              <input type="hidden" name="currentImage" value="<?php echo $post_image; ?>">
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="footer">
    <div class="col-sm-12">
      <hr>
      <p>Все права защищены 2019 | Designed by: Dmitry Ermakovich</p>
      <hr>
    </div>
  </div>
  </div>
  <script type="text/javascript" src="../../js-scripts/jquery.js"></script>
</body>

</html>