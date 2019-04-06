<!-- Controlleur qui appelle le modele.
require les fichiers du modele.
function qui vont etre appellé dans le routeur pour afficher tel ou tel page.-->
<?php

require_once(MODEL.'ChapterManager.php');
require_once(MODEL.'CommentManager.php');

class Front{
    public function listChapters($params){
      $chapterManager = new ChapterManager();


      $chapters = $chapterManager->getChapters();
      require('view/home.php');
    }
    public function chapter($params){

      if (!null == $params->getParams('id') && $params->getParams('id') > 0 )
      {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();

        $chapter = $chapterManager->getChapter($params->getParams('id'));
        $comments = $commentManager->getComments($params->getParams('id'));

        require('view/chapterView.php');
      } else {
        throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
      }
    }
    public function addComment($params){

      $commentManager = new CommentManager();
      $affectedLines = $commentManager ->postComment($params->getParams('id'), $params->getParams('author'), $params->getParams('comment'));

      if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
      }
      else {
          header('Location: index.php?action=chapter&id=' . $params->getParams('id'));
      }
    }
}
