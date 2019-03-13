<?php require_once('../../Include/Sessions.php') ?>
<?php require_once('../../Include/commonFuncs.php') ?>
<?php require_once('../../Include/dbFunctions.php') ?>

<?php adminRequired(); ?>
<?php require_once('../../utils/dashboard_c.php') ?>

<!DOCTYPE html>
<html>

<head>
  <title>Статьи - Панель управления GreatEdu</title>
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
    <div class="main" id="dashboard">
      <div class="row">
        <div class="col-sm-2">
          <ul id="side-menu" class="nav nav-pills nav-stacked">
            <li class="active"><a href="Dashboard.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Статьи</a></li>
            <li class=""><a href="Biographies.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Биографии</a></li>
            <li><a href="NewPost.php">
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
          <div>
            <h1>Статьи</h1>
            <?php echo SuccessMessage(); ?>
            <?php echo Message(); ?>
            <div class="table-responsive">
              <?php fillArticleTable() ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="row navbar-inverse" id="footer">
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