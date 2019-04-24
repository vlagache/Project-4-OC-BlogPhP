
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
          selector: '#tinyMce',
          language: 'fr_FR'
        });
        </script>

        <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <link href="<?= ASSETS;?>css/style.css" rel="stylesheet" />



    </head>

    <body>

      <header>
        <div class="menu">
          <nav class="menuNav">
            <ul>
              <li <?php if ($viewActive == 'listChapters'): ?>class="selected"<?php endif ?>>
                <a href="index.php">Accueil</a>
              </li>
              <li <?php if ($viewActive == 'author'):?>class="selected"<?php endif ?> >
                <a href="index.php?action=author">A propos</a>
              </li>
              <li <?php if ($viewActive == 'chapter'): ?>class="selected"<?php endif ?>>
                <a href="index.php?action=chapter&id=1">Lecture</a>
              </li>
              <li <?php if ($viewActive == 'adminAuth' || $viewActive == 'adminArea'): ?>class="selected"<?php endif ?> >
                <a href="index.php?action=adminAuth">Administration</a>
              </li>
            </ul>
          </nav>

          <div class="adminHeader">
            <div class="adminCo">
              <?php if(isset($_SESSION['admin'])):?>
                <form action="index.php?action=logout" method="post" class="logoutForm">
                    <button type="submit" class="submitDeco"><i class=" iconeLogout fas fa-power-off"></i></button>
                </form>
                <p>
                  Connecté en tant que <?= $_SESSION['admin']; ?>
                </p>
              <?php endif ?>
            </div>
          </div>

        </div>

        <div class="image_title_header">
          <img src="<?= ASSETS;?>images/road-alaska-header.jpg" alt="Photo d'une route en Alaska" class="imgHeader" />
          <div class="textHeader">
            <h1 class="titleMain"> Billet simple pour l'Alaska</h1>
            <span class="introduction"> La publication épisodique du nouveau livre de Jean Forteroche </span>
          </div>
      </header>

      <body>
          <?= $content ?>
      </body>

      <footer>
        <p id="copyright">
          COPYRIGHT 2019 - VINCENT LAGACHE - PROJET ETUDIANT OPENCLASSROOMS
        </p>
        <div id="socialNetwork">
        </div>
      </footer>

      <script src="assets/js/main.js"></script>
    </body>
  </html>
