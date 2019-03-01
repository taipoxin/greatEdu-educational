<?php require_once 'Include/functions.php'?>
<?php require_once 'Include/dbFunctions.php'?>
<?php require_once 'Include/fileFunctions.php'?>

<?php

function updatePost($post_object)
{
    ini_set("safe_mode", false);
    // date_default_timezone_set('Asia/Manila');
    $time = time();
    $title = $post_object['post-title'];

    $image = $_FILES['post-image']['name'];
    $author = $_SESSION['username'];
    $dateTime = strftime('%Y-%m-%d %T', $time);
    $title_length = strlen($title);
    $content_lenght = strlen($content);
    $updatedImage = $image;
    if (empty($image)) {
        $updatedImage = $post_object['currentImage'];
        $newImage = false;
    }
   
    $content = $post_object['post-content'];
    $filename = "post_$post_object[idFromUrl].txt";
    rewriteContentFile($filename, $content);

    $sql = "UPDATE Статьи SET дата_публикации ='$dateTime', заголовок = '$title',
	изображение = '$updatedImage', файл_контент = '$filename' WHERE id = '$post_object[idFromUrl]' ";
    $exec = QueryNew($sql);
    if ($exec) {
        if (!empty($image)) {
						$imageDirectory = "Upload/Image/" . basename($_FILES['post-image']['name']);
            if (move_uploaded_file($_FILES['post-image']['tmp_name'], $imageDirectory)) {
                $_SESSION['successMessage'] = 'Post Edit Successfully: Updated Image';
            } else {
                $_SESSION['errorMessage'] = 'Something Went Wrong With saving file Please Try Again Later';
            }
            Redirect_To('Dashboard.php');
        }
        $_SESSION['successMessage'] = 'Post Edit Successfully';
        Redirect_To('Dashboard.php');
    } else {
        $_SESSION['errorMessage'] = 'Something Went Wrong With db write. Please Try Again Later';
        Redirect_To('Dashboard.php');
    }
}

if (isset($_POST['post-update'])) {
    updatePost($_POST);
} else if (isset($_GET['post_id'])) {
    if (!empty($_GET['post_id'])) {

        $sql = "SELECT * FROM Статьи WHERE id = '$_GET[post_id]'";
        $res = execQuery($sql);
        $post = $res[0];
        $post_id = $post['id'];
        $post_date = $post['дата_публикации'];
        $post_title = $post['заголовок'];
        // $post_category = $post['category'];
        $post_category = 'категория';
        $post_author = $post['автор'];
        $post_image = $post['изображение'];
        $post_file = $post['файл_контент'];
        $text = LoadText($post_file);
        $post_content = $text;
    }
} else {
    Redirect_To('dashboard.php');
}

?>