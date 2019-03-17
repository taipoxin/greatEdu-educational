<?php require_once('../../Include/Sessions.php'); ?>
<?php require_once('../../Include/commonFuncs.php') ?>
<?php require_once('../../Include/dbFunctions.php') ?>
<?php require_once('../../utils/Biographies/bio_c.php') ?>
<?php 
  global $title_title;
	fillHeader();
?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $title_title . ' - GreatEdu'; ?></title>
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
  <link rel="stylesheet" type="text/css" href="/Assets/style.css">
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
          <a href="/" class="navbar-brand">
            Great Edu
          </a>
        </div>
        <div class="collapse navbar-collapse" id="nav-header">
          <ul class="nav navbar-nav">
            <li class="nav-item"><a href="/">Статьи</a></li>
            <li class="nav-item"><a href="/Quotes/">Цитаты</a></li>
            <li class="nav-item"><a href="/Biographies">Биографии</a></li>
          </ul>
          <div class="navbar-right" style="display: flex;">
              <form action="/Search.php" method="GET" class="navbar-form ">
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
                <a href="/Logout.php" style="color: grey;">Выйти</a>
              </button>
              <?php endif; ?>
              <?php if(!$isLogged) : ?>
              <button type="button" class="nav-item btn">
                <a href="/Login.php" style="color: grey;">Войти</a>
              </button>
              <?php endif; ?>

          </div>
        </div>
      </div>
    </nav>
    <!--END OF NAVBAR  -->
    <div class="container">
      <div class="blog-title">
      </div>
      <div class="row">
        <div class="col-md-8">
          <?php echo SuccessMessage(); ?>
          <?php echo Message(); ?>
          <?php echo SESSION_INFO(); ?>
          <?php 
					fillBioData();
				?>
        </div>
        <!--END OF COL-MD-8  -->
        <div class="col-md-3 post-side-menu col-md-offset-1">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="panel-title">Последние биографии</h2>
            </div>
            <div class="panel-body">
              <?php
							fillBioReferences();
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