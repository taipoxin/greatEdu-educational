<?php

function fillDeletingQuote()
{
  $quote_id = 'error';
  $quote_creator = 'error';
  $quote_author = 'error'; 
  $quote_source = 'error';
  $quote_theme = 'error';
  $quote_text = 'error';
  
  if (isset($_GET['quote_id'])) {
    if (!empty($_GET['quote_id'])) {
      $sql = "SELECT * FROM Цитаты WHERE id = '$_GET[quote_id]'";
      $exec = doSQLQuery($sql);
      if (mysqli_num_rows($exec) > 0) {
        if ($quote = mysqli_fetch_assoc($exec)) {
          $quote_id = $quote['id'];
          $quote_author = $quote['автор'];
          $quote_creator = $quote['автор_публикации'];
          $quote_source = $quote['источник'];
          $quote_theme = $quote['тема'];
          $quote_text = $quote['текст'];
          // not used
          $quote_date = $quote['дата_публикации'];
        }
      }
    }
  }
}

function handleDeleteQuote()
{
  if (isset($_POST['quote-delete'])) {
    $sql = "DELETE FROM Цитаты WHERE id = '$_POST[deleteID]' ";
    $exec = doSQLQuery($sql);
    if ($exec) {
      $_SESSION['successMessage'] = "$_POST[deleteID] Quote Deleted Successfully";
      Redirect_To('/Quotes.php');
    } else {
      $_SESSION['errorMessage'] = "Something Went Wrong, Quote Is Not Deleted. Please Try Again Later";
      // Redirect_To('Dashboard.php');
    }
  }
}
