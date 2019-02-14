<?php require_once('Include/Sessions.php'); ?>
<?php require_once('Include/functions.php') ?>
<?php
	if(isset($_POST['submit'])) {
		if(!empty($_POST['submit'])) {
			$postID = $_POST['id'];
			$author = $_POST['author'];
			$comment = $_POST['comment'];
			
			echo 'post:' . $postID . '<br>';
			echo 'author_id:'. $author . '<br>';
			echo 'comment:'. $comment . '<br>';

			// TODO: write to db

			Redirect_To("Post.php?id=$postID");
		}
	}

	// if(isset($_POST['submit'])) {
	// 	if(!empty($_POST['submit'])) {
	// 		date_default_timezone_set('Asia/Manila');
	// 		$time = time();
	// 		$dateTime = strftime('%Y-%m-%d %H:%M:%S ',$time);
	// 		$postID = $_POST['id'];
	// 		$email = $_POST['email'];
	// 		$comment = $_POST['comment'];
	// 		$status = 'unapprove';
	// 		$sql = "INSERT INTO comment (date_time, email, comment, status, post_id) VALUES('$dateTime', '$email', '$comment', '$status', '$postID' )";
	// 		$exec = Query($sql);
	// 		if ($exec) {
	// 			$_SESSION['successMessage'] = "Your Comment Has Been Submitted. We Will Notify You If Your Post Has Been Approved Via Email";
	// 			mysqli_close($con);
	// 			Redirect_To("Post.php?id=$postID");
	// 		}else {
	// 			$_SESSION['errorMessage'] = "Something Went Wrong Please Try Again Later";
	// 		}
	// 	}
	// }
?>