<?php
require_once 'DatabaseLoad.php';

// common functions

function Redirect_To($location)
{
  try {
    header('location:' . $location);
    exit;
  } catch (Exception $e) {
    // echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
}

function LoadTextFromContentFileDashboard($file)
{
  $post_content = '';
  if (is_null($file)) {
    $post_content = 'error load';
  } else {
    $post_content = file_get_contents('../Upload/contents/' . $file);
  }
  return $post_content;
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

function LoadTextFromBioFile($file)
{
  $post_content = '';
  if (is_null($file)) {
    $post_content = 'error load';
  } else {
    $post_content = file_get_contents('../Upload/bios/' . $file);
  }
  return $post_content;
}
// write to content file
function rewriteContentFile($filename, $content)
{
  $filepath = "../Upload/contents/$filename";
  file_put_contents($filepath, $content);
}

function rewriteFileByPath($filepath, $content)
{
  file_put_contents($filepath, $content);
}

// require title, author, content
function validateQuote($creatorId, $author, $content)
{
  if (empty($creatorId) || empty($author) || empty($content)) {
    $_SESSION['errorMessage'] = "All Fields Must Be Fill Out $creatorId, $author, $content";
    return false;
  } else if (strlen($content) > 2000) {
    $_SESSION['errorMessage'] = 'Content Is Too Long';
    return false;
  } else {
    return true;
  }
}

function validatePost($title, $content, $image)
{
  if (empty($title) || empty($content) || empty($image)) {
    $_SESSION['errorMessage'] = "All Fields Must Be Fill Out $title, $content, $image";
    return false;
  } else if (strlen($title) > 300) {
    $len = strlen($title);
    $_SESSION['errorMessage'] = "Title Is Too Long: $len";
    return false;
  } else if (strlen($content) > 40000) {
    $_SESSION['errorMessage'] = 'Content Is Too Long';
    return false;
  } else {
    return true;
  }
}
?>
