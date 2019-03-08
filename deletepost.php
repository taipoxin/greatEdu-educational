<?php require_once('Include/Sessions.php'); ?>
<?php require_once('src/deletepost_c.php') ?>
<?php loginRequired(); ?>
<?php 
global $post_title, $post_image, $post_content;
?>

<!DOCTYPE html>
<html>

<head>
  <title>Delete Post</title>
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
            <li class=""><a href="NewPost.php">
                <span class="glyphicon glyphicon-list"></span>
                &nbsp;New Post</a></li>
            <li class=""><a href="Categories.php">

            <li><a href="Categories.php">
                <span class="glyphicon glyphicon-user"></span>
                &nbsp;Manage Admin</a></li>
            <li><a href="Dashboard.php">
                <span class="glyphicon glyphicon-comment"></span>
                &nbsp;Comments</a></li>
            <li><a href="Blog.php">
                <span class="glyphicon glyphicon-equalizer"></span>
                &nbsp;Live Blog</a></li>
            <li><a href="Lagout.php">
                <span class="glyphicon glyphicon-log-out"></span>
                &nbsp;Lagout</a></li>
          </ul>
        </div>
        <div class="col-xs-10">
          <div class="page-title">
            <h1>Delete Post</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <form action="deletepost.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <button name="post-delete" class="btn btn-danger form-control">DELETE</button>
              </div>
              <div class="form-group">
                <labal for="post-title">Title</labal>
                <input disabled type="text" name="post-title" class="form-control" id="post-title"
                  value="<?php echo $post_title ?>">
              </div>
              <label>Existing Image: <img src="Upload/Image/<?php echo $post_image;  ?>" width='250' height='90'>
              </label>
              <div class="form-group">
                <labalkok for="post-image">Change Image</labalkok>
                <input disabled type="File" name="post-image" class="form-control">
              </div>
              <div class="form-group">
                <labal for="post-content">Existing Content</labal>
                <textarea disabled rows="20" class="form-control" name="post-content"
                  id="post-content"><?php echo htmlentities($post_content); ?></textarea>
              </div>
              <input type="hidden" name="deleteID" value="<?php echo $_GET['delete_post_id']; ?>">
              <input type="hidden" name="currentImage" value="<?php echo $post_image; ?>">
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