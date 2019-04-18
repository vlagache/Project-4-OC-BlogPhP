<?php
class Front {
    private $viewActive;


    public function __construct($params)
    {

      $this->viewActive = $params->getAction();
    }
    // Tout les chapitres
    public function listChapters($params){
      $chapterManager = new ChapterManager();
      $commentManager = new CommentManager();

      $chapters = $chapterManager->getChapters();
      $comments = $commentManager->getLastComments();

      $title = 'Billet simple pour l\'Alaska par Jean Forteroche';
      $myView = new View('home');
      $myView->render(array('chapters' => $chapters, 'comments' => $comments, 'title' => $title, 'viewActive' => $this->viewActive));

    }
    public function chapter($params){

      if (!null == $params->getParam('id') && $params->getParam('id') > 0 )
      {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();


        $chapter = $chapterManager->getChapter($params->getParam('id'));
        $comments = $commentManager->getComments($params->getParam('id'));

        $title = $chapter->getTitle();
        $myView = new View('chapterView');
        $myView->render(array('chapter' => $chapter, 'comments' => $comments, 'title' => $title, 'viewActive' => $this->viewActive));
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

      $viewActive = $this->viewActive;

      $chapterManager = new ChapterManager();
      $commentManager = new CommentManager();

      $chapters = $chapterManager->getChapters();
      $comments = $commentManager->getLastComments();

      if (isset($_SESSION['admin']))
      {
        $title = 'Zone Administration';
        $myView = new View('adminAreaView');
        $myView->render(array('chapters' => $chapters, 'comments' => $comments, 'title' => $title, 'viewActive' => $viewActive));
      } else {
        $title = 'Zone Login Administration';
        $myView = new View('adminAuthView');
        $myView->render(array('title' => $title, 'viewActive' => $this->viewActive));

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

      $chapterManager = new ChapterManager();
      $commentManager = new CommentManager();

      $chapters = $chapterManager->getChapters();
      $comments = $commentManager->getLastComments();

      $viewActive = $this->viewActive;


      if (isset($_SESSION['admin']))
      {
          $title = 'Zone Administration';
          $myView = new View('adminAreaView');
          $myView->render(array('chapters' => $chapters, 'comments' => $comments, 'title' => $title, 'viewActive' => $viewActive));

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


//
// // Affiche ou cache en fonction de l'existence de $_SESSION['admin'];
//   public function adminLog($params){
//     $admin = array();
//
//     if(isset($_SESSION['admin'])){
//       $admin =  [
//                     'adminCo' => 'div-show',
//                     'adminDeco' => 'div-hide'
//                 ];
//     } else {
//       $admin =  [
//                     'adminCo' => 'div-hide',
//                     'adminDeco' => 'div-show'
//                 ];
//     }
//     return $admin;
//   }
