<?php
require_once 'DatabaseLoad.php';

// common functions


function Redirect_To($location)
{
  header('location:' . $location);
  exit;
}

function LoadTextFromContentFile($file)
{
  $post_content = '';
  if (is_null($file)) {
    $post_content = 'error load';
  } else {
    $post_content = file_get_contents('Upload/contents/' . $file);
  }
  return $post_content;
}

// write to content file
function rewriteContentFile($filename, $content)
{
  $filepath = "Upload/contents/$filename";
  file_put_contents($filepath, $content);
}


function validatePost($title, $content, $image) 
{
  if (empty($title) || empty($content) || empty($image)) {
    $_SESSION['errorMessage'] = "All Fields Must Be Fill Out $title, $content, $image";
    return false;
  } else if (strlen($title) > 100) {
    $len = strlen($title);
    $_SESSION['errorMessage'] = "Title Is Too Long: $len";
    return false;
  } else if (strlen($content) > 4000) {
    $_SESSION['errorMessage'] = 'Content Is Too Long';
    return false;
  } else {
    return true;
  }
}

