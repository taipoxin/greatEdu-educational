<?php require_once 'Include/Sessions.php';?>
<?php require_once 'Include/functions.php'?>
<?php require_once 'Include/dbFunctions.php'?>
<?php require_once 'Include/fileFunctions.php'?>

<!DOCTYPE html>
<html>

<head>
  <title>Blog</title>
  <script src="public/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="public/Assets/style.css">
  <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="blog">
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
            DMITRY ERMAKOVICH
          </a>
        </div>
        <div class="collapse navbar-collapse" id="nav-header">
          <ul class="nav navbar-nav">
            <li class="active"><a href="Blog.php">HOME</a></li>
          </ul>
          <form action="Blog.php" method="GET" class="navbar-form navbar-right">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search The Site">
              <span class="input-group-btn">
                <button class="btn btn-default"><span class="glyphicon glyphicon-search"></button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </nav>
    <!--END OF NAVBAR  -->
    <div class="container">
      <div class="blog-title">
        <div class="row">
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
						require_once 'src/blog_c.php'?>
        </div>
        <!--END OF COL-MD-8  -->
        <div class="col-md-3 col-md-offset-1 post-side-menu">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="panel-title">About Articles</h2>
            </div>
            <div>
              <!-- <img class="img-responsive img-circle imageicon" src="Assets/Images/user-default.png"> -->
            </div>
            <div class="panel-body">
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
              industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
              scrambled it to make a type specimen book
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="panel-title">Recent Post</h2>
            </div>
            <div class="panel-body">

            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="panel-title">Some more info</h2>
            </div>
            <div class="panel-body">
              <nav>
                <ul class="nav-left-list">

                </ul>
              </nav>
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
      <p>All Rights Reserved 2019 | Theme By : Dmitry Ermakovich</p>
    </div>
  </div>
</body>

</html>