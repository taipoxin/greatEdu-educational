<?php require_once('Include/functions.php') ?>
<?php require_once('Include/dbFunctions.php') ?>
<?php
if (isset($_POST['post-delete'])) {
    $sql = "DELETE FROM Статьи WHERE id = '$_POST[deleteID]' ";
    $exec = QueryNew($sql);
    if ($exec) {
        $_SESSION['successMessage'] = "Post Deleted Successfully";
        Redirect_To('Dashboard.php');
    } else {
        $_SESSION['errorMessage'] = "Something Went Wrong, Post Is Not Deleted. Please Try Again Later";
        Redirect_To('Dashboard.php');
    }

} else if (isset($_GET['delete_post_id'])) {
    if (!empty($_GET['delete_post_id'])) {
        $sql = "SELECT * FROM Статьи WHERE id = '$_GET[delete_post_id]'";
        $exec = QueryNew($sql);
        if (mysqli_num_rows($exec) > 0) {
            if ($post = mysqli_fetch_assoc($exec)) {
                $post_id = $post['id'];
                $post_date = $post['дата_публикации'];
                $post_title = $post['заголовок'];
                $post_category = 'категория';
                $post_image = $post['изображение'];
                
                $post_file = $post['файл_контент'];
                $text = LoadText($post_file);
                $post_content = $text;
                
                $author_id = $post['автор'];
                $author_obj = getArticleAuthor($author_id);
                $post_author = $author_obj['никнейм'];

            }
        }
    }
} else {
    Redirect_To('dashboard.php');
}
