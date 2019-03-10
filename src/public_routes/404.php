<?php require_once '../Include/Sessions.php';?>
<?php require_once '../Include/commonFuncs.php'?>
<?php require_once '../Include/dbFunctions.php'?>

<?php require_once '../utils/blog_c.php'  ?>

<!DOCTYPE html>
<html>

<head>
  <title>404 - GreatEdu</title>
  <script src="../js-scripts/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../js-scripts/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../js-scripts/Assets/style.css">
  <script type="text/javascript" src="../js-scripts/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="blog" style="min-height: -webkit-fill-available;">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-header">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="Blog.php" class="navbar-brand">
            Great Edu
          </a>
        </div>
        <div class="collapse navbar-collapse" id="nav-header">
          <ul class="nav navbar-nav">
            <li class="nav-item active"><a href="Blog.php">Статьи</a></li>
            <li class="nav-item"><a href="Quotes.php">Цитаты</a></li>
            <li class="nav-item"><a href="Blog.php">Биографии</a></li>
          </ul>
          <div class="navbar-right" style="display: flex;">
              <form action="Blog.php" method="GET" class="navbar-form ">
                <div class="input-group" style="width:200px;">
                  <input type="text" name="search" class="form-control" placeholder="Поиск по сайту">
                  <span class="input-group-btn">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-search"></button>
                  </span>
                </div>
              </form>
              <?php $isLogged = isLogin(); ?>

              <?php if($isLogged) : ?>
              <button type="button" class="nav-item btn">
                <a href="Lagout.php" style="color: grey;">Выйти</a>
              </button>
              <?php endif; ?>
              <?php if(!$isLogged) : ?>
              <button type="button" class="nav-item btn">
                <a href="Login.php" style="color: grey;">Войти</a>
              </button>
              <?php endif; ?>
          </div> 
        </div>
      </div>
    </nav>
    <!--END OF NAVBAR  -->
    <div class="container">
      <?php echo SuccessMessage(); ?>
      <?php echo Message(); ?>
      <?php echo SESSION_INFO(); ?>
      <div style="text-align: center;">
        <h1 style="font-size: 5em;">404 - Страница не найдена</h1>
        <div class="thumbnail" style="border: 0px;">
          <img class="img-responsive img-rounded" style="max-height: 500px;" src="images/404_image.png">
        </div>
      </div>
    </div>
  </div>
  <div class="row navbar-inverse" id="blog-footer">
    <div class="footer-wrapper">
      <p>Все права защищены 2019 | Designed by: Dmitry Ermakovich</p>
    </div>
  </div>
</body>

</html>