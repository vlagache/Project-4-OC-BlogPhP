<!-- Controlleur qui appelle le modele.
require les fichiers du modele.
function qui vont etre appellé dans le routeur pour afficher tel ou tel page.-->



<?php

require_once(MODEL.'ChapterManager.php');
require_once(MODEL.'CommentManager.php');
require_once(MODEL.'AdminManager.php');

class Front{
  // Affiche ou cache en fonction de l'existence de $_SESSION['admin'];
    public function adminLog($params){
      $admin = array();

      if(isset($_SESSION['admin'])){
        $admin =  [
                      'adminCo' => 'div-show',
                      'adminDeco' => 'div-hide'
                  ];
      } else {
        $admin =  [
                      'adminCo' => 'div-hide',
                      'adminDeco' => 'div-show'
                  ];
      }
      return $admin;
    }

    // Renvoie la vue active
    public function menuActive($params){
      $viewActive = $params->getAction();
      return $viewActive;
    }

    public function listChapters($params){
      $chapterManager = new ChapterManager();
      $commentManager = new CommentManager();

      $adminLog = $this->adminLog($params);
      $viewActive = $this->menuActive($params);

      $chapters = $chapterManager->getChapters();
      $comments = $commentManager->getLastComments();

      require('view/home.php');
    }
    public function chapter($params){

      $adminLog = $this->adminLog($params);
      $viewActive = $this->menuActive($params);

      if (!null == $params->getParam('id') && $params->getParam('id') > 0 )
      {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();


        $chapter = $chapterManager->getChapter($params->getParam('id'));


        $comments = $commentManager->getComments($params->getParam('id'));

        require('view/chapterView.php');
      } else {
        throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
      }
    }
    public function addComment($params){
      if (!null == $params->getParam('id') && $params->getParam('id') > 0 )
      {
        if(!null == $params->getParam('author') && !null == $params->getParam('comment'))
        {
          $commentManager = new CommentManager();
          $affectedLines = $commentManager ->postComment($params->getParam('id'), $params->getParam('author'), $params->getParam('comment'));

          if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
          }
          else {
              header('Location: index.php?action=chapter&id=' . $params->getParam('id'));
          }

        } else {
          throw new Exception('Tous les champs ne sont pas remplis !');
        }
      } else {
        throw new Exception ('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
      }

    }
    public function adminAuth($params){
      $adminLog = $this->adminLog($params);
      $viewActive = $this->menuActive($params);

      if (isset($_SESSION['admin']))
      {
        require ('view/adminAreaView.php');
      } else {
        require ('view/adminAuthView.php');
      }

    }
    public function checkPassword($params){
      if (!null == $params->getParam('password') && !null == $params->getParam('login'))
      {
        $adminManager = new AdminManager();
        $admin = $adminManager->getAdmin($params->getParam('login'));
        if (password_verify($params->getParam('password'),$admin['password']))
        {
          $_SESSION['admin'] = $admin['login'];
          header('Location: index.php?action=adminArea');
        } else {
          throw new Exception('Mauvais mot de passe ');
        }
      }
      else {
      throw new Exception ('Login ou Mot de passe non saisi');
      }
    }
    public function adminArea($params){
      $adminLog = $this->adminLog($params);
      $viewActive = $this->menuActive($params);
      
      if (isset($_SESSION['admin']))
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
