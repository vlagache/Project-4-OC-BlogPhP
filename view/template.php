
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="<?= ASSETS;?>css/style.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
          <div class="adminArea">
            <i class="lock fas fa-unlock-alt"></i>
            <div class="adminText">
              <a href="index.php?action=adminAuth"> Administration </a>
            </div>
          </div>
        </div>
    </footer>
</html>
