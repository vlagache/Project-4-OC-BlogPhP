<!-- Controlleur qui appelle le modele.
require les fichiers du modele.
function qui vont etre appellé dans le routeur pour afficher tel ou tel page.-->
<?php

require_once('model/ChapterManager.php');

function listChapters(){
  // Creation d'un objet ChapterManager
  // Appel d'une methode sur cet Objet qui recupere tout les articles
  // $ variable = $ChapterManager->getChapters();
  // Require la vue souhaité et on traite l'affichage de la vue dans le fichier vue souhaite.
  // home.php
  $chapterManager = new ChapterManager();
  $chapters = $chapterManager->getChapters();
  require('view/home.php');
}
function chapter(){
  $chapterManager = new ChapterManager();
  $chapter = $chapterManager->getChapter($_GET['id']);
  require('view/chapterView.php');
}
