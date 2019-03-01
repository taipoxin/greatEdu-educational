<?php

function rewriteContentFile($filename, $content)
{
    $filepath = "Upload/contents/$filename";
    file_put_contents($filepath, $content);
}

?>