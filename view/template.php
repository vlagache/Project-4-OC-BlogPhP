<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="<?= ASSETS;?>css/style.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    </head>

    <header>
      <div class="image_title_header">
        <img src="<?= ASSETS;?>images/road-alaska-header.jpg" alt="Photo d'une route en Alaska" class="imgHeader" />
        <div class="textHeader">
          <h1 class="titleMain"> Billet simple pour l'Alaska</h1>
          <span class="introduction"> La publication épisodique du nouveau livre de Jean Forteroche </span>
        </div>
      </div>
    </header>

    <body>
        <?= $content ?>
    </body>

    <footer>
        <div class="footer">
          Contact / Reseaux sociaux / Copyright
          Zone admin
        </div>
    </footer>
</html>
