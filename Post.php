<?php require_once('Include/Sessions.php'); ?>
<?php require_once('Include/functions.php') ?>
<?php require_once('Include/dbFunctions.php') ?>
<?php require_once('Include/fileFunctions.php') ?>
<?php require_once('src/post_c.php') ?>
<?php 
	fillHeader();
?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $title_title; ?></title>
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
            <li class=""><a href="#">HOME</a></li>

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
      </div>
      <div class="row">
        <div class="col-md-8">
          <?php echo SuccessMessage(); ?>
          <?php echo Message(); ?>
          <?php echo SESSION_INFO(); ?>
          <?php 
					fillPostData();
				?>
          <div class="comment-section">
            <?php if(isLogin()) : ?>
            <form method="POST" action="comment.php">
              <legend>Your Thoughts About This Post</legend>
              <div class="form-group">
                <label>Comment</label>
                <textarea name="comment" placeholder="Your Comment Here" class="form-control" rows="10"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Send Comment">
              </div>
              <input type="hidden" name="author" value="<?php echo $_SESSION['user_id']; ?>">
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            </form>
            <?php endif; ?>

          </div>
          <div class="page-header">Comments</div>
          <?php
					fillPostComments();
				?>

        </div>
        <!--END OF COL-MD-8  -->
        <div class="col-md-3 post-side-menu col-md-offset-1">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2 class="panel-title">About Me</h2>
            </div>
            <div>
              <img class="img-responsive img-circle imageicon" src="public/Assets/Images/user-default.png">
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
              <?php
							fillPostsReferences();
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
      <p>All Rights Reserved 2019 | Theme By : Dmitry Ermakovich</p>
    </div>
  </div>
</body>

</html>