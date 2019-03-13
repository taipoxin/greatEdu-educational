<?php require_once '../../Include/Sessions.php';?>
<?php require_once '../../Include/commonFuncs.php'?>
<?php require_once '../../Include/dbFunctions.php'?>

<?php adminRequired();?>
<?php require_once '../../utils/admin_c.php'?>

<!DOCTYPE html>
<html>

<head>
  <title>Администраторы - Панель управления GreatEdu</title>
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
            <li class=""><a href="Biographies.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Биографии</a></li>
            <li><a href="NewPost.php">
                <span class="glyphicon glyphicon-list"></span>
                &nbsp;Новая статья</a></li>
            <li class="active"><a href="Admin.php">
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
            <h1>Администраторы</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <div>
            <div class="row">
              <div class="col-md-12 ">
                <form method="POST" action="Admin.php">
                  <fieldset>
                    <div class="form-group">
                      <label for="username">Никнейм</label>
                      <input class="form-control input-md" type="text" name="username" placeholder="Никнейм">
                    </div>
                    <div class="form-group">
                      <label for="username">Email</label>
                      <input class="form-control input-md" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="password">Пароль</label>
                      <input class="form-control input-md" type="Password" name="password" placeholder="Пароль">
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Подтвердите пароль</label>
                      <input class="form-control input-md" type="Password" name="confirm_password"
                        placeholder="Подтвердите пароль">
                    </div>
                    <div class="form-group">
                      <input class="form-control btn btn-primary" type="submit" name="submit"
                        value="Зарегистрировать нового администратора">
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
            <div id="cat_table">
              <h3>Добавленные администраторы</h3>
              <table class="table table-striped table-hover">
                <tr>
                  <th>номер</th>
                  <th>id</th>
                  <th>Дата изменения</th>
                  <th>никнейм</th>
                  <th>Действие</th>
                </tr>
                <?php
                retrieveAdmins();
                ?>
              </table>
            </div>
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