<?php
class AdminController {
    private $viewActive;

    public function __construct($params)
    {

      $this->viewActive = $params->getAction();
    }
    public function author($params)
    {
      $chapterManager = new ChapterManager();
      $chapters = $chapterManager->getChapters(); // Footer

      $title = 'A propos de l\'auteur';
      $myView = new View('authorView');
      $myView-> render(array('chapters' => $chapters, 'title' => $title, 'viewActive' => $this->viewActive));
    }
    public function adminAuth($params){

      $viewActive = $this->viewActive;

      $chapterManager = new ChapterManager();
      $commentManager = new CommentManager();

      $chapters = $chapterManager->getChapters();
      $comments = $commentManager->getLastComments();

      $nbReportCom = $commentManager->nbReportCom();


      if (isset($_SESSION['admin']))
      {
        $title = 'Zone Administration';
        $myView = new View('adminAreaView');
        $myView->render(array('chapters' => $chapters, 'comments' => $comments, 'title' => $title, 'viewActive' => $viewActive, "nbReportCom" => $nbReportCom));
      } else {
        $title = 'Zone Login Administration';
        $myView = new View('adminAuthView');
        $myView->render(array('chapters' => $chapters, 'title' => $title, 'viewActive' => $this->viewActive));

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
          throw new Exception('Mauvais identifiant ou mauvais mot de passe ');
        }
      }
      else {
      throw new Exception ('Identifiant ou Mot de passe non saisi');
      }
    }
    public function adminArea($params){

      $chapterManager = new ChapterManager();
      $commentManager = new CommentManager();

      $chapters = $chapterManager->getChapters();
      $comments = $commentManager->getLastComments();

      $nbReportCom = $commentManager->nbReportCom();

      $viewActive = $this->viewActive;

      if (isset($_SESSION['admin']))
      {
          $title = 'Zone Administration';
          $myView = new View('adminAreaView');
          $myView->render(array('chapters' => $chapters, 'comments' => $comments, 'title' => $title, 'viewActive' => $viewActive, 'nbReportCom' => $nbReportCom));

      } else {
        throw new Exception('Accés non autorisé');
      }

    }
    public function logout($params)
    {
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
