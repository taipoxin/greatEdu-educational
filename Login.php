<?php
include('Include/Sessions.php');
include('Include/functions.php');
include('Include/dbFunctions.php');
if ( isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($username) || empty($password)) {
		$_SESSION['errorMessage'] = 'All Fields Must Be Fill Out';
	}else {
		$foundAccount = LoginAttempt($username, $password);
		if ($foundAccount) {

			$_SESSION['errorMessage'] = $foundAccount;
			$_SESSION['successMessage'] = 'Login Successfully Welcome ' . $foundAccount['никнейм'];
			$_SESSION['user_id'] = $foundAccount['id'];
			$_SESSION['username'] = $foundAccount['никнейм'];
			// если админ
			if ($foundAccount['группа'] == '2') {
				Redirect_To('Dashboard.php');
			}
			else {
				Redirect_To('Blog.php');
			}
		}else {
			$_SESSION['errorMessage'] = 'Username/Password Is Invalid';
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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
		<h1>Welcome Back!</h1>
		<div class="">
			<form method="POST" action="Login.php">
				<legend class="lead"><h4>Login With Your Username And Password</h4></legend>
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
			</form>
		</div>
	</div>
</div>
</body>
</html>