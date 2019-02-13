<?php require_once('Include/Sessions.php'); ?>
<?php require_once('Include/functions.php') ?>
<?php 
	if ( isset($_GET['id']) ) {
		$post_id = $_GET['id'];
		$post_title = "";
		$sql = "SELECT * FROM cms_post WHERE post_id = '$post_id'";
		$exec = Query($sql);
		if ($title = mysqli_fetch_assoc($exec)) {
			$post_title = $title['title'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $post_title; ?></title>
	<script src="jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/style.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
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
					ALGER MAKIPUTIN
				</a>
			</div>
			<div class="collapse navbar-collapse" id="nav-header">
				<ul class="nav navbar-nav">
					<li class=""><a href="#" >HOME</a></li>
				
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
	</nav> <!--END OF NAVBAR  -->
	<div class="container">
		<div class="blog-title">
		</div>
		<div class="row">
			<div class="col-md-8">
				<?php echo SuccessMessage(); ?>
				<?php echo Message(); ?>
				<?php
					if( isset($_GET['id'])) {
						$query = "SELECT * FROM cms_post WHERE post_id = '$_GET[id]'";
						$exec = Query($query);
						if (mysqli_num_rows($exec) > 0) {
							while ($post = mysqli_fetch_assoc($exec) ) {
								$post_id = $post['post_id'];
								$post_date = $post['post_date_time'];
								$post_title = $post['title'];
								$post_category = $post['category'];
								$post_author = $post['author'];
								$post_image = $post['image'];
								$post_content = $post['post']; 
							?>
							<div class="post">
								<div class="post-title"><h1><?php echo htmlentities($post_title); ?></h1></div>
								<div class="thumbnail">
									<img class="img-responsive img-rounded" src="Upload/Image/<?php echo $post_image; ?>">
								</div>
								<div class="post-info">
									<p class="lead">
									Published on: <?php echo htmlentities($post_date); ?> | Category: <?php echo htmlentities($post_category);?> | By: <?php echo $post_author; ?>
									</p>
								</div>
								<div class="post-content">
								<p class="lead"><?php echo nl2br($post_content); ?></p>
								</div>
							</div>
							<?php
							}
						}
					}else {
						Redirect_To('Blog.php');
					}
				?>
				<div class="comment-section">
					<form method="POST" action="comment.php?>'"> 
						<legend>Your Thoughts About This Post</legend>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" placeholder="Your Email Address" class="form-control">
						</div>
						<div class="form-group">
							<label>Comment</label>
							<textarea name="comment" placeholder="Your Comment Here" class="form-control" rows="10"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-primary" value="Send Comment">
						</div>
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					</form>
				</div>
				<div class="page-header">Comments</div>
				<?php
					$sql = "SELECT * FROM comment WHERE post_id = '$_GET[id]'";
					$exec = Query($sql);
					if (mysqli_num_rows($exec) > 0) {
						while ($comments = mysqli_fetch_assoc($exec)) {
							$c_email = $comments['email'];
							$c_dateTime = $comments['date_time'];
							$c_comment = $comments['comment'];
							?>
							
							<div class="comment-block" style="margin-bottom: 20px; ">
								<div class="row">
									<div class="col-sm-2" style="height: 70px;width: 100px; padding:0; margin:0;">
									<img src="Assets/Images/user-default.png" height="70px" width="100px">
									</div>
									<div class="col-sm-10">
										<div><span class="lead text-info"><?php echo $c_email; ?></span></div>
										<div><span><?php echo $c_dateTime; ?></span></div>
										<div><span class="lead"> Say: <?php echo $c_comment; ?></span></div>
									</div>
								</div>
							</div>

							<?php
						}
					}else {
							echo "No Comments Yet";
						}
				?>
				
			</div><!--END OF COL-MD-8  -->
			<div class="col-md-3 post-side-menu col-md-offset-1">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">About Me</h2>
					</div>
					<div>
							<img class="img-responsive img-circle imageicon" src="Assets/Images/user-default.png">
						</div>
					<div class="panel-body">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Recent Post</h2>
					</div>
					<div class="panel-body">
						<?php
							$sql = "SELECT * FROM cms_post ORDER BY post_date_time LIMIT 5";
							$exec = Query($sql);
							while ($recentPost = mysqli_fetch_assoc($exec)) {
								$postID = $recentPost['post_id'];
								?>
								<nav>
									<ul>
										<li><a href="Post.php?id=<?php echo $postID; ?>"><?php echo $recentPost['title'] ?></a></li>
									</ul>
								</nav>
								<?php
							}
						?>
					</div>
				</div>

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Categories</h2>
					</div>
					<div class="panel-body">
						<nav>
							<ul>
						<?php 
							$sql = "SELECT cat_name FROM cms_category ";
							$exec = Query($sql);
							if (mysqli_num_rows($exec) > 0) {
								while ($category = mysqli_fetch_assoc($exec)) {
									?>
									<li><a href="Blog.php?category=<?php echo $category['cat_name'] ?>"><?php echo $category['cat_name'] ?></a></li>
									<?php
								}
							}	
						?>
							
								
							</ul>
						</nav>
					</div>
				</div>
			</div> <!--END OF COL-MD-4  -->
		</div> <!--END OF ROW  -->
	</div>
</div>
<div class="row navbar-inverse" id="blog-footer">
	<div class="footer-wrapper">
		<p>All Rights Reserved 2017 | Theme By :  Alger Makiputin</p>
	</div>
</div>
</body>
</html>