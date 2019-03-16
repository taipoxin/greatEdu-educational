<?php require_once '../../Include/Sessions.php';?>
<?php require_once '../../Include/commonFuncs.php'?>
<?php require_once '../../Include/dbFunctions.php'?>

<?php 
global $bio_id,
  $bio_author, 
  $bio_state,
  $bio_sphere,
  $bio_date,
  $bio_period,
  $bio_content,
  $bio_image;
?>
<?php require_once '../../utils/Biographies/deleteBio_c.php'?>
<?php adminRequired();?>


<?php handleDeleteBio();?>
<?php fillDeletingBio();?>

<!DOCTYPE html>
<html>

<head>
  <title>Удалить биографию - GreatEdu</title>
  <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
  crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="/Assets/style.css">
</head>

<body>
  <div class="blog" style="min-height: -webkit-fill-available;">
    <nav class="navbar navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-header">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="/" class="navbar-brand">
                Great Edu
              </a>
            </div>
            <div class="collapse navbar-collapse" id="nav-header">
              <ul class="nav navbar-nav">
                <li class="nav-item"><a href="/">Статьи</a></li>
                <li class="nav-item"><a href="/Quotes/">Цитаты</a></li>
                <li class="nav-item"><a href="/Biographies">Биографии</a></li>
              </ul>
              <div class="navbar-right" style="display: flex;">
                  <form action="/Quotes/" method="GET" class="navbar-form ">
                    <div class="input-group" style="width:200px;">
                      <input type="text" name="search" class="form-control" placeholder="Поиск по сайту">
                      <span class="input-group-btn">
                        <button style="padding: 5.5px 12px;" class="btn btn-default"><span class="glyphicon glyphicon-search"></button>
                      </span>
                    </div>
                  </form>
                  <?php $isLogged = isLogin(); ?>

                  <?php if($isLogged) : ?>
                  <button type="button" class="nav-item btn">
                    <a href="/Logout.php" style="color: grey;">Выйти</a>
                  </button>
                  <?php endif; ?>
                  <?php if(!$isLogged) : ?>
                  <button type="button" class="nav-item btn">
                    <a href="/Login.php" style="color: grey;">Войти</a>
                  </button>
                  <?php endif; ?>

              </div>
            </div>
          </div>
        </nav>
        <div class="container" style="min-height: -webkit-fill-available;">
          <div class="page-title">
            <h1>Удалить биографию</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <form action="deleteBio.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <p for="quote-author">Номер биографии</p>
                <input disabled type="text" name="bio-id" class="form-control" id="quote-id"
                value="<?php echo $bio_id ?>">
              </div>
              <div class="form-group">
                <p for="quote-author">ФИО Автора</p>
                <input disabled type="text" name="bio-author" class="form-control" id="quote-author"
                value="<?php echo $bio_author ?>">
              </div>
              <div class="form-group">
                <p for="quote-author">Страна принадлежности</p>
                <input disabled type="text" name="bio-state" class="form-control" id="quote-author"
                value="<?php echo $bio_state ?>">
              </div>
              <div class="form-group">
                <p for="quote-source">Сферы деятельности</p>
                <input disabled type="text" name="bio-sphere" class="form-control" id="quote-source"
                value="<?php echo $bio_sphere ?>">
              </div>
              <div class="form-group">
                <p for="quote-theme">Период</p>
                <input disabled type="text" name="bio-period" class="form-control" id="quote-theme"
                value="<?php echo $bio_period ?>">
              </div>
              <div class="form-group">
                <p for="quote-theme">Дата добавления</p>
                <input disabled type="text" name="bio-date" class="form-control" id="quote-theme"
                value="<?php echo $bio_date ?>">
              </div>
              <div style="display:flex">
                <p>Изображение:  </p>
                <?php
                  $img = "/Upload/bios/$bio_image?m=";
                ?>
                <img src="<?php echo $img . time(); ?>" width='250' height='90'>
              </div>
              <div class="form-group">
                <p for="quote-content">Текст</p>
                <textarea disabled rows="10" class="form-control" name="quote-content" 
                id="quote-content"><?php echo htmlentities($bio_content); ?></textarea>
              </div>
              <div class="form-group">
                <button name="bio-delete" class="btn btn-danger form-control">Удалить биографию</button>
              </div>
              <input type="hidden" name="deleteID" value="<?php echo $_GET['bio_id']; ?>">
            </fieldset>
          </form>
        </div>
  <div class="row navbar-inverse" id="blog-footer">
    <div class="footer-wrapper">
      <p>Все права защищены 2019 | Designed by: Dmitry Ermakovich</p>
    </div>
  </div>
  </div>
  <script type="text/javascript" src="../js-scripts/jquery.js"></script>
</body>

</html>