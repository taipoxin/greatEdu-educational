<?php require_once('../../Include/Sessions.php'); ?>
<?php require_once('../../Include/commonFuncs.php') ?>
<?php require_once('../../Include/dbFunctions.php') ?>

<?php require_once('../../utils/editpost_c.php') ?>
<?php adminRequired(); ?>
<?php 

  global $post_title, $post_image, $post_content;
  if (isset($_GET['post_id'])) {
    fillEditData();
  }
  else if (isset($_POST['post-update'])) {
    handleUpdatePost();
  }
  else {
    Redirect_To('Dashboard.php');
  }
?>

<!DOCTYPE html>
<html>

<head>
  <title>Изменить статью - Панель управления GreatEdu</title>
  <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
  crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="/js-scripts/Assets/styles.css">
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
            <h1>Изменить статью</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <form action="editpost.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <p for="post-title">Заголовок</p>
                <input type="text" name="post-title" class="form-control" id="post-title"
                  value="<?php echo $post_title ?>">
              </div>
              <div class="form-group">

              </div>
              <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
              <label>Изображение: <img src="../../Upload/Image/<?php echo $post_image  . '?m=';  ?>" width='250' height='90'>
              </label>
              <div class="form-group">
                <p for="post-image">Изменить изображение</p>
                <input type="File" name="post-image" class="form-control">
              </div>
              <div class="form-group">
                <p for="post-content">Текст (поддерживает HTML)</p>
                <textarea rows="20" class="form-control" name="post-content"
                  id="post-content"><?php echo htmlentities($post_content); ?></textarea>
              </div>
              <input type="hidden" name="idFromUrl" value="<?php echo $_GET['post_id']; ?>">
              <input type="hidden" name="currentImage" value="<?php echo $post_image; ?>">
              <div class="form-group">
                <button name="post-update" class="btn btn-primary form-control">UPDATE</button>
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