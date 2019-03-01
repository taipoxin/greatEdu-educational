<?php require_once('Include/Sessions.php'); ?>
<?php require_once('Include/functions.php') ?>
<?php ConfirmLogin(); ?>
<?php
if ( isset( $_POST['post-update'])) {
	ini_set("safe_mode",false);
	// date_default_timezone_set('Asia/Manila');
	$time = time();
	$title = mysqli_real_escape_string($con, $_POST['post-title']);
	// $category = mysqli_real_escape_string($con, $_POST['post-category']);
	$content = mysqli_real_escape_string($con, $_POST['post-content']);
	$image = $_FILES['post-image']['name'];
	$author = $_SESSION['username'];
	$dateTime = strftime('%Y-%m-%d %T',$time);
	$title_length = strlen($title);
	$content_lenght = strlen($content);
	$updatedImage = $image;
	if( empty($image)) {
		$updatedImage = $_POST['currentImage'];
		$newImage = false;
	}
	$imageDirectory = "Upload/Image/" . basename($_FILES['post-image']['name']);
	// echo $imageDirectory;
	// echo $_FILES['post-image'];
	$sql = "UPDATE Статьи SET дата_публикации ='$dateTime', заголовок = '$title',  изображение = '$updatedImage', файл_контент = '$content' WHERE id = '$_POST[idFromUrl]' ";
	$exec = QueryNew($sql);
	if($exec) {
		if (!empty($image) && move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory)) {
			$_SESSION['successMessage'] = 'Post Edit Successfully';
		}
		else {
			$_SESSION['errorMessage'] = 'Something Went Wrong With saving file Please Try Again Later';
		}
		// $_SESSION['imgDir'] = $imageDirectory;
		// $_SESSION['img'] = $_FILES['post-image'];
		// echo $_FILES['post-image']['tmp_name'];
		// echo $imageDirectory;
		Redirect_To('Dashboard.php');
	}else {
		$_SESSION['errorMessage'] = 'Something Went Wrong With db write. Please Try Again Later';
		Redirect_To('Dashboard.php');
	}

}else if( isset($_GET['post_id'])) {
	if (!empty($_GET['post_id'])) {
		$sql = "SELECT * FROM Статьи WHERE id = '$_GET[post_id]'";
		$exec = QueryNew($sql);
		if (mysqli_num_rows($exec) > 0 ) {
			if ($post = mysqli_fetch_assoc($exec)) {
				$post_id = $post['id'];
				$post_date = $post['дата_публикации'];
				$post_title = $post['заголовок'];
				// $post_category = $post['category'];
				$post_category = 'категория';
				$post_author = $post['автор'];
				$post_image = $post['изображение'];
				$post_content = 'текст_поста';
			}
		} 
	}
}else {
	Redirect_To('dashboard.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Post</title>
	<script src="jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/style.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="heading">
	<a href=""><p>Visit Blog</p></a>
</div>
<div class="container-fluid">
	<div class="main">
		<div class="row">
			<div class="col-sm-2">
				<ul id="side-menu" class="nav nav-pills nav-stacked">
					<li class=""><a href="Dashboard.php">
					<span = class="glyphicon glyphicon-th"></span>
					 &nbsp;Dashboard</a></li>
					<li class=""><a href="NewPost.php">
					<span = class="glyphicon glyphicon-list"></span>
					&nbsp;New Post</a></li>
					<li class=""><a href="Categories.php">
					<span = class="glyphicon glyphicon-tags"></span>
					&nbsp;Categories</a></li>
					<li><a href="Categories.php">
					<span = class="glyphicon glyphicon-user"></span>
					&nbsp;Manage Admin</a></li>
					<li><a href="Admin.php">
					<span = class="glyphicon glyphicon-comment"></span>
					&nbsp;Comments</a></li>
					<li><a href="Blog.php">
					<span = class="glyphicon glyphicon-equalizer"></span>
					&nbsp;Live Blog</a></li>
					<li><a href="Lagout.php">
					<span = class="glyphicon glyphicon-log-out"></span>
					&nbsp;Lagout</a></li>
				</ul>
			</div>
			<div class="col-xs-10">
				<div class="page-title"><h1>Update Post</h1></div>
					<?php echo Message(); ?>
					<?php echo SuccessMessage(); ?>
					<form action="editpost.php" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<labal for="post-title">Title</labal>
								<input type="text" name="post-title" class="form-control" id="post-title" value="<?php echo $post_title ?>">
							</div>
							<div class="form-group">
								<label>Existing Category : <?php echo htmlentities($post_category); ?></label><br>
								<!-- <label for="post-category">Change Category</label>
								<select class="form-control" name="post-category" id="post-category" value="<?php echo $post_category ?>">
									<?php
										$sql = "SELECT cat_name FROM cms_category";
										$exec = Query($sql);
										$selected = "";
										while($row = mysqli_fetch_assoc($exec)){ 
											// if ( $row['cat_name'] == $post_category ) {
											// 	$select = 'selected';
											// }
											if($post_category === $row['cat_name']) {
												?>
												<option selected="selected" ><?php echo htmlentities($row['cat_name']) ?></option>
												<?php
											}else {
												?>
												<option><?php echo htmlentities($row['cat_name']) ?></option>
												<?php
											}
										}
									?>
								</select> -->
							</div>
							<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
							<label>Existing Image: <img src="Upload/Image/<?php echo $post_image;  ?>" width='250' height='90'> </label>
							<div class="form-group">
								<labal for="post-image">Change Image</labal>
								<input type="File" name="post-image" class="form-control">
							</div>
							<div class="form-group">
								<labal for="post-content">Existing Content</labal>
								<textarea rows="20" class="form-control" name="post-content" id="post-content"><?php echo htmlentities($post_content);  mysqli_close($con); ?></textarea>
							</div>
							<input type="hidden" name="idFromUrl" value="<?php echo $_GET['post_id']; ?>">
							<input type="hidden" name="currentImage" value="<?php echo $post_image; ?>">
							<div class="form-group">
								<button name="post-update" class="btn btn-primary form-control">UPDATE</button>
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
			<p>All Rights Reserved 2019 | Theme By :  Dmitry Ermakovich</p>
		<hr>
		</div>
	</div>
</div>
<script type="text/javascript" src="jquery.js"></script>
</body>
</html>