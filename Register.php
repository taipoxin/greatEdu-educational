<?php
include 'Include/Sessions.php';
include 'Include/functions.php';
include 'Include/dbFunctions.php';
require_once 'src/register_c.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
  <script src="public/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="public/Assets/login.css">
</head>

<body>
  <div class="row">
    <div class="col-md-4 col-md-offset-4 login-area">
      <?php echo Message(); ?>
      <?php echo SESSION_INFO(); ?>
      <h1>Welcome to Register Page</h1>
      <div class="">
        <form method="POST" action="Register.php">
          <legend class="lead">
            <h4>Enter your credentials</h4>
          </legend>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="username" class="form-control input-lg" placeholder="Username">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" name="email" class="form-control input-lg" placeholder="Email">
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
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-lock"></span>
              </span>
              <input type="password" name="confirm-password" class="form-control input-lg" placeholder="Confirm Password">
            </div>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="form-control input-lg btn btn-info" value="Register">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>