<?php require_once('../Include/Sessions.php') ?>
<?php require_once('../Include/commonFuncs.php') ?>
<?php require_once('../Include/dbFunctions.php') ?>

<?php adminRequired(); ?>
<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <script src="../js-scripts/jquery-3.2.1.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../js-scripts/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../js-scripts/Assets/style.css">
  <script type="text/javascript" src="../js-scripts/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="heading">
    <a href="">
      <p>Visit Blog</p>
    </a>
  </div>
  <div class="container-fluid">
    <div class="main" id="dashboard">
      <div class="row">
        <div class="col-sm-2">
          <ul id="side-menu" class="nav nav-pills nav-stacked">
            <li class="active"><a href="Dashboard.php">
                <span class="glyphicon glyphicon-th"></span>
                &nbsp;Dashboard</a></li>
            <li><a href="NewPost.php">
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
          <div>
            <h1>Dashboard</h1>
            <?php echo SuccessMessage(); ?>
            <?php echo Message(); ?>
            <div class="table-responsive">

              <?php 
							// echo implode(',', $_SESSION['img']) . '<br>';
							// echo $_SESSION['imgDir'];
							$sql = "SELECT * FROM Статьи ORDER BY дата_публикации";
							$exec = doSQLQuery($sql);
							$postNo = 1;
							if(mysqli_num_rows($exec) < 1	) {
								?>
              <p class="lead">You Have 0 Post For The Moment</p>
              <a href="NewPost.php"><button class="btn btn-info">Add Post</button></a>
              <?php
							}else{ ?>
              <table class="table table-hover">
                <tr>
                  <th>Id</th>
                  <th>Post Date</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Category</th>
                  <th>Feature Image</th>
                  <th>Comments</th>
                  <th>Action</th>
                  <th>Details</th>
                </tr>
                <?php
								while ($post = mysqli_fetch_assoc($exec)) {
									$post_id = $post['id'];
									$post_date = $post['дата_публикации'];
									$post_title = $post['заголовок'];
									// $category = $post['category'];
									$category = 'категория';
									$author = "автор";
									$image = $post['изображение'];
									?>
                <tr>
                  <td><?php echo $post_id; ?></td>
                  <td><?php echo $post_date; ?></td>
                  <td><?php 
									if(strlen($post_title) > 42 ) {
										echo substr($post_title,0,42) . '...';
									}else {
										echo $post_title;
									}
					
									?></td>
                  <td><?php echo $author; ?></td>
                  <td><?php echo $category; ?></td>
                  <td>
                    <?php echo "<img class='img-responsive' src='../Upload/Image/$image' width='100px' height='150px'>"; ?>
                  </td>
                  <td><?php echo 'Ongoing'; ?></td>
                  <td>
                    <?php echo "<a href='editpost.php?post_id=$post_id'>Edit</a> | <a href='deletepost.php?delete_post_id=$post_id'>Delete</a>"; ?>
                  </td>
                  <td><a href="Post.php?id=<?php echo $post_id; ?>"><button class="btn btn-primary">Live
                        Preview</button></a></td>
                </tr>
                <?php
									$postNo++;
								}
							}
							?>
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

  <script type="text/javascript" src="../js-scripts/jquery.js"></script>
</body>

</html>