<?php

function QueryNew ($query) {
	global $con2;

	try {

		$exec = mysqli_query($con2,$query) or die(mysqli_error($con2));
		if($exec) {
			return $exec;
		}
	
	}catch (Exception $e) {
		echo $e->getMessage();
	}

	return false;
}

function execQuery($query) {
  $exec = QueryNew($query) or die(mysqli_error($con));
  if( $exec ) {
    $arr = [];
    if (mysqli_num_rows($exec) > 0) {
      while ( $post = mysqli_fetch_assoc($exec) ) {
        array_push($arr, $post);
      }
    }
    return $arr;
  }
  return null;
}

function getArticleAuthor($id) {
  $query = "SELECT * FROM Пользователи WHERE id = $id";
  $resultArray = execQuery($query);
  $author = $resultArray[0];
  return $author;
}



?>