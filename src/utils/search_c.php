<?php

$isProduced = false;

function produceAuthor($obj)
{
  $author_id = $obj['id'];
  $author_surname = $obj['фамилия'];
  $author_name = $obj['имя'];
  $author_second_name = $obj['отчество'];
  $date = $obj['дата_добавления'];
  $isProduced = true;
  ?>
      <div class="post" style="border: black solid 1px; border-radius: 5px; background-color: burlywood;" >
        <div style="display: flex; justify-content: space-between;">
          <div class="post-info">
            <p class="lead" style="color: darkblue;">
              Автор произведений:
              <a href="/Biographies/Bio.php?id=<?php echo $author_id ?>">
                <?php echo htmlentities("$author_surname $author_name $author_second_name"); ?>
              </a>
            </p>
            <p class="lead" style="color: darkblue;">
              <?php echo 'Дата: ' . $date; ?>
            </p>
          </div>
        </div>
        </div>
<?php
}


function produceArticle($obj)
{
  $article_id = $obj['id'];
  $article_title = $obj['заголовок'];
  $article_date = $obj['дата_публикации'];
  $isProduced = true;
  ?>
      <div class="post" style="border: black solid 1px; border-radius: 5px; background-color: lightgreen;" >
        <div style="display: flex; justify-content: space-between;">
          <div class="post-info">
            <p class="lead" style="color: darkblue;">
              Статья:
              <a href="/Article.php?id=<?php echo $article_id ?>">
                <?php echo htmlentities("$article_title"); ?>
              </a>
            </p>
            <p class="lead" style="color: darkblue;">
              <?php echo 'Дата: ' . $article_date; ?>
            </p>
          </div>
        </div>
        </div>
<?php
}

function produceQuote($obj)
{
  $quote_id = $obj['id'];
  $quote_text = $obj['текст'];
  $quote_date = $obj['дата_публикации'];
  $isProduced = true;
  ?>
      <div class="post" style="border: black solid 1px; border-radius: 5px; background-color: lightgrey;" >
        <div style="display: flex; justify-content: space-between;">
          <div class="post-info">
            <p class="lead" style="color: darkblue;">
              Цитата:
              <a href="/Quotes/Quote.php?id=<?php echo $quote_id ?>">
                <?php echo htmlentities("$quote_date"); ?>
              </a>
            </p>
            <p class="lead" style="color: darkblue;">
              <?php echo mb_substr($quote_text, 0, 60, "utf-8") . '...'; ?>
            </p>
          </div>
        </div>
        </div>
<?php
}

function searchAuthorOnColumnAndProduce($searchQuery, $column)
{
  $query = "SELECT * FROM Авторы WHERE $column like '%$searchQuery%'";
  $arr = execQueryToArray($query);
  foreach ($arr as &$value) {
    if (!empty($value)) {
      produceAuthor($value);
    }
  }
}

function searchArticleOnColumnAndProduce($searchQuery, $column)
{
  $query = "SELECT * FROM Статьи WHERE $column like '%$searchQuery%'";
  $arr = execQueryToArray($query);
  foreach ($arr as &$value) {
    if (!empty($value)) {
      produceArticle($value);
    }
  }
}

function searchQuoteOnColumnAndProduce($searchQuery, $column)
{
  $query = "SELECT * FROM Цитаты WHERE $column like '%$searchQuery%'";
  $arr = execQueryToArray($query);
  foreach ($arr as &$value) {
    if (!empty($value)) {
      produceQuote($value);
    }
  }
}

function searchAndProduceAuthor($searchQuery)
{
  searchAuthorOnColumnAndProduce($searchQuery, 'фамилия');
  searchAuthorOnColumnAndProduce($searchQuery, 'имя');
  searchAuthorOnColumnAndProduce($searchQuery, 'отчество');
  searchAuthorOnColumnAndProduce($searchQuery, 'дата_добавления');
}


function searchAndProduceArticle($searchQuery)
{
  searchArticleOnColumnAndProduce($searchQuery, 'заголовок');
  searchArticleOnColumnAndProduce($searchQuery, 'дата_публикации');
}

function searchAndProduceQuote($searchQuery)
{
  searchQuoteOnColumnAndProduce($searchQuery, 'текст');
  searchQuoteOnColumnAndProduce($searchQuery, 'дата_публикации');
}

function fillSearch()
{
  global $con2;
  if (isset($_GET['search'])) {
    if (empty($_GET['search'])) {
      Redirect_To('/');
    }
  } else {
    Redirect_To('/');
  }

  $searchBy = $_GET['search'];
  searchAndProduceAuthor($searchBy);
  searchAndProduceArticle($searchBy);
  searchAndProduceQuote($searchBy);
  if (!$isProduced) {
    echo "<span class='lead'>Нет результатов<span>";
  }

}

?>