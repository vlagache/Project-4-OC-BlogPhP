<!-- Controlleur qui appelle le modele.
require les fichiers du modele.
function qui vont etre appellé dans le routeur pour afficher tel ou tel page.-->



<?php

require_once(MODEL.'ChapterManager.php');
require_once(MODEL.'CommentManager.php');
require_once(MODEL.'AdminManager.php');

class Front{
    public function listChapters($params){
      $chapterManager = new ChapterManager();
      $commentManager = new CommentManager();


      $chapters = $chapterManager->getChapters();
      $comments = $commentManager->getLastComments();

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
      if (!null == $params->getParams('id') && $params->getParams('id') > 0 )
      {
        if(!null == $params->getParams('author') && !null == $params->getParams('comment'))
        {
          $commentManager = new CommentManager();
          $affectedLines = $commentManager ->postComment($params->getParams('id'), $params->getParams('author'), $params->getParams('comment'));

          if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
          }
          else {
              header('Location: index.php?action=chapter&id=' . $params->getParams('id'));
          }

        } else {
          throw new Exception('Tous les champs ne sont pas remplis !');
        }
      } else {
        throw new Exception ('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
      }

    }
    public function adminAuth($params){
      if (isset($_SESSION['user']))
      {
        require ('view/adminAreaView.php');
      } else {
        require ('view/adminAuthView.php');
      }

    }
    public function checkPassword($params){ //Ne require pas une vue , juste en arriere plan puis header Location blabla
      if (!null == $params->getParams('password') && !null == $params->getParams('login'))
      {
        $adminManager = new AdminManager();
        $admin = $adminManager->getAdmin($params->getParams('login'));
        if (password_verify($params->getParams('password'),$admin['password']))
        {
          $_SESSION['user'] = $admin['login'];
          header('Location: index.php?action=adminArea');
        } else {
          throw new Exception('Mauvais mot de passe ');
        }
      }
      else {
      throw new Exception ('Login ou Mot de passe non saisi');
      }

      //
      // Si il existe un $_SESSION['xxx'] alors =>
      // on va la zone admin header(location : blabla)
      // Sinon message d'erreur
    }
    public function adminArea($params){
      if (isset($_SESSION['user']))
      {
        require ('view/adminAreaView.php');
      } else {
        throw new Exception('Accés non autorisé');
      }
    }
    public function logout($params){
      // Suppression des variables de session et de la session
      $_SESSION = array();
      session_destroy();

      // Suppression des cookies de connexion automatique
      setcookie('login', '');
      setcookie('password', '');
      header('Location: index.php');
    }
}
