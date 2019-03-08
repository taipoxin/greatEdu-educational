<?php require_once 'Include/Sessions.php';?>
<?php require_once 'Include/functions.php'?>
<?php require_once 'Include/dbFunctions.php'?>
<?php require_once 'Include/fileFunctions.php'?>
<?php require_once 'src/newpost_c.php'?>
<?php adminRequired();?>
<?php // TODO: old, should be refactored
handleNewPost();
?>
<!DOCTYPE html>
<html>

<head>
  <title>New Post</title>
  <script src="public/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="public/Assets/style.css">
  <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="heading">
    <a href="">
      <p>Visit Blog</p>
    </a>
  </div>
  <div class="container-fluid">
    <div class="main">
      <div class="row">
        <div class="col-sm-2">
          <ul id="side-menu" class="nav nav-pills nav-stacked">
            <li class=""><a href="Dashboard.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Dashboard</a></li>
            <li class="active"><a href="NewPost.php">
                <span class="glyphicon glyphicon-list"></span>
                &nbsp;New Post</a></li>
            <li><a href="Admin.php">
                <span class="glyphicon glyphicon-user"></span>
                &nbsp;Manage Admin</a></li>
            <li><a href="Blog.php">
                <span class="glyphicon glyphicon-equalizer"></span>
                &nbsp;Live Blog</a></li>
            <li><a href="Lagout.php">
                <span class="glyphicon glyphicon-log-out"></span>
                &nbsp;Lagout</a></li>
          </ul>
        </div>
        <div class="col-xs-10" style="min-height: -webkit-fill-available;">
          <div class="page-title">
            <h1>Add New Post</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <form action="NewPost.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <labal for="post-title">Title</labal>
                <input type="text" name="post-title" class="form-control" id="post-title">
              </div>
              <div class="form-group">
                <labal for="post-image">Feature Image</labal>
                <input type="File" name="post-image" class="form-control">
              </div>
              <div class="form-group">
                <labal for="post-content">Content</labal>
                <textarea rows="10" class="form-control" name="post-content" id="post-content">

								</textarea>
              </div>
              <div class="form-group">
                <button name="post-submit" class="btn btn-primary form-control">Publish</button>
              </div>
            </fieldset>
          </form>
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
  <script type="text/javascript" src="public/jquery.js"></script>
</body>

</html>