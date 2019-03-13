<?php require_once '../../Include/Sessions.php';?>
<?php require_once '../../Include/commonFuncs.php'?>
<?php require_once '../../Include/dbFunctions.php'?>

<?php require_once '../../utils/newpost_c.php'?>
<?php adminRequired();?>

<?php handleNewPost();?>
<!DOCTYPE html>
<html>

<head>
  <title>Новая статья - Панель управления GreatEdu</title>
  <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
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
            <li class=""><a href="Biographies.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Биографии</a></li>
            <li class="active"><a href="NewPost.php">
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
        <div class="col-xs-10" style="min-height: -webkit-fill-available;">
          <div class="page-title">
            <h1>Добавить новую статью</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <form action="NewPost.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <p for="post-title">Заголовок</p>
                <input type="text" name="post-title" class="form-control" id="post-title">
              </div>
              <div class="form-group">
                <p for="post-image">Главное изображение</p>
                <input type="File" name="post-image" class="form-control">
              </div>
              <div class="form-group">
                <p for="post-content">Текст (поддерживает HTML)</p>
                <textarea rows="10" class="form-control" name="post-content" id="post-content"></textarea>
              </div>
              <div class="form-group">
                <button name="post-submit" class="btn btn-primary form-control">Опубликовать</button>
              </div>
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
  
</body>

</html>