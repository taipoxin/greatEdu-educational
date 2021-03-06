<?php require_once '../../Include/Sessions.php';?>
<?php require_once '../../Include/commonFuncs.php'?>
<?php require_once '../../Include/dbFunctions.php'?>

<?php require_once '../../utils/Biographies/editBio_c.php'?>
<?php adminRequired();?>

<?php
global $bio_id,
  $biography,
  $bio_author_surname,
  $bio_author_name,
  $bio_author_second_name,
  $bio_state,
  $bio_sphere,
  $bio_date,
  $bio_period,
  $bio_content,
  $bio_image;
?>

<?php handleUpdateBio();?>
<?php fillEditingBio();?>

<!DOCTYPE html>
<html>

<head>
  <title>Изменить биографию - GreatEdu</title>
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
                  <form action="/Search.php" method="GET" class="navbar-form ">
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
            <h1>Изменить биографию</h1>
          </div>
          <?php echo Message(); ?>
          <?php echo SuccessMessage(); ?>
          <form action="editBio.php?bio_id=<?php echo $_GET['bio_id'] ?>" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
                <p for="quote-author">Номер биографии</p>
                <input disabled type="text" name="bio-id" class="form-control" id="quote-id"
                value="<?php echo $bio_id ?>">
              </div>
              <div class="form-group">
                <p for="quote-author">Фамилия Автора</p>
                <input type="text" name="bio-author-surname" class="form-control" id="quote-author"
                value="<?php echo $bio_author_surname ?>">
              </div>
              <div class="form-group">
                <p for="quote-author">Имя Автора</p>
                <input type="text" name="bio-author-name" class="form-control" id="quote-author"
                value="<?php echo $bio_author_name ?>">
              </div>
              <div class="form-group">
                <p for="quote-author">Отчество Автора</p>
                <input type="text" name="bio-author-second-name" class="form-control" id="quote-author"
                value="<?php echo $bio_author_second_name ?>">
              </div>
              <div class="form-group">
                <p for="quote-author">Страна принадлежности</p>
                <input type="text" name="bio-state" class="form-control" id="quote-author"
                value="<?php echo $bio_state ?>">
              </div>
              <div class="form-group">
                <p for="quote-source">Сферы деятельности</p>
                <input type="text" name="bio-sphere" class="form-control" id="quote-source"
                value="<?php echo $bio_sphere ?>">
              </div>
              <div class="form-group">
                <p for="quote-theme">Период</p>
                <input type="text" name="bio-period" class="form-control" id="quote-theme"
                value="<?php echo $bio_period ?>">
              </div>
              <div style="display:flex">
                <p>Изображение:  </p>
                <!-- https://stackoverflow.com/a/22429796/7410224 -->
                <?php
                  $img = "/Upload/bios/$bio_image?m=";
                ?>
                <img src="<?php echo $img . time()?>" width='250' height='90'>
              </div>
              <br>
              <div class="form-group">
                <p for="post-image">Изменить изображение</p>
                <input type="File" name="post-image" class="form-control">
              </div>
              <div class="form-group">
                <p for="quote-content">Текст</p>
                <textarea rows="10" class="form-control" name="bio-content" 
                id="bio-content"><?php echo htmlentities($bio_content); ?></textarea>
              </div>
              <div class="form-group">
                <button name="bio-edit" class="btn btn-primary form-control">Изменить биографию</button>
              </div>
              <input type="hidden" name="currentImage" value="<?php echo $bio_image; ?>">
              <input type="hidden" name="editID" value="<?php echo $_GET['bio_id']; ?>">
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