<?php require_once '../Include/Sessions.php';?>
<?php require_once '../Include/commonFuncs.php'?>
<?php require_once '../Include/dbFunctions.php'?>

<?php require_once '../utils/blog_c.php'  ?>

<!DOCTYPE html>
<html>

<head>
  <title>Статьи - GreatEdu</title>
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
            <li class="nav-item"><a href="/Bios.php">Биографии</a></li>
          </ul>
          <div class="navbar-right" style="display: flex;">
              <form action="Blog.php" method="GET" class="navbar-form ">
                <div class="input-group" style="width:200px;">
                  <input type="text" name="search" class="form-control" placeholder="Поиск по сайту">
                  <span class="input-group-btn">
                    <button style="padding: 5.5px 12px;" class="btn btn-default"><span class="glyphicon glyphicon-search"></button>
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
      <div class="blog-title">
        <div class="row">
        <?php $isAdmined = isAdmin(); ?>

        <?php if($isAdmined) : ?>
        <div class="text-warning">
          <a href="Dashboard">
            <p>Перейти к панели управления</p>
          </a>
        </div>
        <?php endif; ?>
        <?php echo SuccessMessage(); ?>
        <?php echo Message(); ?>
        <?php echo SESSION_INFO(); ?>
          <div class="col-md-8 ">
            <h1 class="text-warning">Статьи</h1>
            <p class="lead"></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <?php // заполнить все статьями
            fillBlog();
            ?>

        <ul class="pagination pagination-lg">
          <?php
            fillPages();
					?>
        </ul>
        </div>
        <!--END OF COL-MD-8  -->
        <div class="col-md-3 col-md-offset-1 post-side-menu">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="panel-title">Статьи</h2>
            </div>
            <div>
              <!-- <img class="img-responsive img-circle imageicon" src="Assets/Images/user-default.png"> -->
            </div>
            <div class="panel-body">
              Дополнительная информация
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="panel-title">Последние статьи</h2>
            </div>
            <div class="panel-body">
              <?php
                fillBlogPostsReferences();
              ?>
            </div>
          </div>
        </div>
        <!--END OF COL-MD-4  -->
      </div>
      <!--END OF ROW  -->
    </div>
  </div>
  <div class="row navbar-inverse" id="blog-footer">
    <div class="footer-wrapper">
      <p>Все права защищены 2019 | Designed by: Dmitry Ermakovich</p>
    </div>
  </div>
</body>

</html>