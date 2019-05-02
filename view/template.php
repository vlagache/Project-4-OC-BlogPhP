
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://fonts.googleapis.com/css?family=Abel|Amatic+SC" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

          <div class="navbar-fixed">
            <nav class="white teal-text text-lighten-1">
              <div class="nav-wrapper">
                <a href="#" class="blue-grey-text text-darken-3 brand-logo">JEAN FORTEROCHE</a>
                <a href="#" data-target="mobile-demo" class=" sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li <?php if ($viewActive == 'listChapters'): ?>class="selected"<?php endif ?>>
                    <a href="index.php">ACCUEIL</a>
                  </li>
                  <li <?php if ($viewActive == 'author'):?>class="selected"<?php endif ?> >
                    <a href="index.php?action=author">A PROPOS</a>
                  </li>
                  <li <?php if ($viewActive == 'chapter'): ?>class="selected"<?php endif ?>>
                    <a href="index.php?action=chapter&id=1">LECTURE</a>
                  </li>
                  <li <?php if ($viewActive == 'adminAuth' || $viewActive == 'adminArea'): ?>class="selected"<?php endif ?> >
                    <a href="index.php?action=adminAuth">ADMINISTRATION</a>
                  </li>
                  <li>
                    <?php if(isset($_SESSION['admin'])):?>
                      <a href="index.php?action=logout" class="btn-floating tooltipped teal lighten-1" data-position="bottom" data-tooltip="Déconnexion <?= $_SESSION['admin'] ?>"><i class="material-icons">lock</i></a>
                    <?php endif ?>
                  </li>
                </ul>
              </div>
            </nav>
          </div>



          <ul class="sidenav" id="mobile-demo">
            <li <?php if ($viewActive == 'listChapters'): ?>class="selected"<?php endif ?>>
              <a href="index.php">ACCUEIL</a>
            </li>
            <li <?php if ($viewActive == 'author'):?>class="selected"<?php endif ?> >
              <a href="index.php?action=author">A PROPOS</a>
            </li>
            <li <?php if ($viewActive == 'chapter'): ?>class="selected"<?php endif ?>>
              <a href="index.php?action=chapter&id=1">LECTURE</a>
            </li>
            <li <?php if ($viewActive == 'adminAuth' || $viewActive == 'adminArea'): ?>class="selected"<?php endif ?> >
              <a href="index.php?action=adminAuth">ADMINISTRATION</a>
            </li>
            <li>
              <?php if(isset($_SESSION['admin'])):?>
                <a href="index.php?action=logout" class="btn-small tooltipped waves-effect waves-light" data-position="bottom" data-tooltip="Déconnexion <?= $_SESSION['admin'] ?>">Se deconnecter</a>
              <?php endif ?>
            </li>
         </ul>

        </div>
      </header>


      <main>
        <?= $content ?>
      </main>



      <footer class="page-footer">

        <div class="container">
          <div class="row">

            <div class="col s12 m6 l6 xl4">
              <h5 class="blue-grey-text text-darken-3">A propos de ce blog</h5>
              <p class="teal-text text-lighten-1"> La publication épisodique du nouveau roman de Jean Forteroche </p>
            </div>

            <div class="col s12 m6 l6 xl2">
              <h5 class="blue-grey-text text-darken-3">Pages</h5>
              <ul>
                <li><a class="teal-text text-lighten-1" href="#!">Accueil</a></li>
                <li><a class="teal-text text-lighten-1" href="#!">A propos </a></li>
                <li><a class="teal-text text-lighten-1" href="#!">Lecture</a></li>
                <li><a class="teal-text text-lighten-1" href="#!">Administration</a></li>
              </ul>
            </div>

            <div class="col s12 m6 l6 xl5">
              <h5 class="blue-grey-text text-darken-3">Table des matières</h5>
              <ul>
                <?php foreach ($chapters as $chapter):?>
                  <li>
                    <a class="teal-text text-lighten-1" href="index.php?action=chapter&amp;id=<?= $chapter->getId()?>"><?=$chapter->getTitle()?></a>
                  </li>
                <?php endforeach ?>
              </ul>
            </div>

            <div class="col s12 m6 l6 xl1">
              <h5 class="blue-grey-text text-darken-3">Réseaux sociaux</h5>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter-square"></i>
                <i class="fab fa-instagram"></i>
            </div>

          </div>
        </div>

        <div class="footer-copyright">
          <div class="container">
          <a class="teal-text text-lighten-1" href="#!">  © 2019 Vincent Lagache - Projet étudiant OpenClassrooms</a>
          </div>
        </div>

      </footer>

    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/slider.js"></script>
    <script src="assets/js/main.js"></script>

    </body>
  </html>
