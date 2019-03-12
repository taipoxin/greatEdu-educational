<?php

function getLastQuoteId()
{
  $sql = "SELECT MAX(id) as 'max_id' FROM Цитаты";
  $exec = doSQLQuery($sql);
  if ($data = mysqli_fetch_assoc($exec)) {
    return $data['max_id'];
  }
  return null;
}

function handleNewQuote()
{
  global $_POST, $_SESSION;
  if (isset($_POST['quote-submit'])) {

    $quote_author = $_POST['quote-author'];
    $quote_content = $_POST['quote-content'];
    $quote_creator_id = $_SESSION['user_id'];

    $validationResult = validateQuote($quote_creator_id, $quote_author, $quote_content);
    if (!$validationResult) {
      return;
    }

    $quote_source = $_POST['quote-source'];
    $quote_theme = $_POST['quote-theme'];
    if (empty($quote_source)) {
      $quote_source = 'NULL';
    }
    if (empty($quote_theme)) {
      $quote_theme = 'NULL';
    }

    $lastId = getLastQuoteId();
    $quote_id = $lastId + 1;

    $time = time();
    $dateTime = strftime('%Y-%m-%d %T', $time);

    $sql = "INSERT INTO Цитаты (id, автор, текст, источник, тема,
      автор_публикации, дата_публикации)
      VALUES ($quote_id, $quote_author, '$quote_content',
      $quote_source, $quote_theme, '$quote_creator_id', '$dateTime')";
    
    // return;
    $exec = doSQLQuery($sql);

    if ($exec) {
      $_SESSION['successMessage'] = 'Quote Added Successfully';
    } else {
      $_SESSION['errorMessage'] = 'Error: sql wrong - '. $sql;
      // $_SESSION['errorMessage'] = 'Something wrong with insert to db';
    }
  }
}
