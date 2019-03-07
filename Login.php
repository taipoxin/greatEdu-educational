<?php
include 'Include/Sessions.php';
include 'Include/functions.php';
include 'Include/dbFunctions.php';
include 'src/login_c.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>Login page</title>
  <script src="public/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="public/Assets/login.css">
</head>

<body>
  <div class="row">
    <div class="col-md-4 col-md-offset-4 login-area" style="min-width: 500px;">
      <?php echo Message(); ?>
      <?php echo SESSION_INFO(); ?>
      <h1>Welcome Back!</h1>
      <div class="">
        <form method="POST" action="Login.php">
          <legend class="lead">
            <h4>Login With Your Username And Password</h4>
          </legend>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="username" class="form-control input-lg" placeholder="Username">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-lock"></span>
              </span>
              <input type="password" name="password" class="form-control input-lg" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="form-control input-lg btn btn-info" value="Login">
          </div>
          <div class="form-group" style="display: flex; 
          flex-flow: wrap; justify-content: space-between;">
            <a href="Register.php" style="background-color: grey; width: 45%;" class="form-control btn btn-info" >Register me</a>
            <a href="Blog.php" style="background-color: grey; width: 45%;" class="form-control btn btn-info" >Go to Blog</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>