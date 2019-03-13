<?php
include '../Include/Sessions.php';
include '../Include/commonFuncs.php';
include '../Include/dbFunctions.php';
include '../utils/login_c.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>Вход - GreatEdu</title>
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
  <link rel="stylesheet" type="text/css" href="../js-scripts/Assets/login.css">
</head>

<body>
  <div class="row">
    <div class="col-md-4 col-md-offset-4 login-area" style="min-width: 500px;">
      <?php echo Message(); ?>
      <?php echo SESSION_INFO(); ?>
      <h1>Вход в аккаунт на GreatEdu</h1>
      <div class="">
        <form method="POST" action="Login.php">
          <legend class="lead">
            <h4>Войдите со своим никнеймом и паролем</h4>
          </legend>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="username" class="form-control input-lg" placeholder="Никнейм">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-lock"></span>
              </span>
              <input type="password" name="password" class="form-control input-lg" placeholder="Пароль">
            </div>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="form-control input-lg btn btn-info" value="Войти">
          </div>
          <div class="form-group" style="display: flex; 
          flex-flow: wrap; justify-content: space-between;">
            <a href="Register.php" style="background-color: grey; width: 45%;" class="form-control btn btn-info" >Зарегистрироваться</a>
            <a href="Blog.php" style="background-color: grey; width: 45%;" class="form-control btn btn-info" >На главную</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>