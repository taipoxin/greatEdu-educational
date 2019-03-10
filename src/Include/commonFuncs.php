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


