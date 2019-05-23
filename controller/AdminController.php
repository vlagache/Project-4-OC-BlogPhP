<?php
class AdminController {
    private $viewActive;

    public function __construct($request)
    {

      $this->viewActive = $request->getRoute();
    }
    public function author($request)
    {
      $chapterManager = new ChapterManager();
      $chapters = $chapterManager->getChapters(); // Footer

      $title = 'A propos de l\'auteur';
      $myView = new View('authorView');
      $myView-> render(array('chapters' => $chapters, 'title' => $title, 'viewActive' => $this->viewActive));
    }
    public function adminAuth($request){

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
    public function checkPassword($request){
      if (!null == $request->get('password') && !null == $request->get('login'))
      {
        $adminManager = new AdminManager();
        $admin = $adminManager->getAdmin($request->get('login'));
        if (password_verify($request->get('password'),$admin['password']))
        {
          $_SESSION['admin'] = $admin['login'];
          $myView = new View('adminArea');
          $myView -> header();
          // header('Location: ' . HOST . 'adminArea');

        } else {
          throw new Exception('Mauvais identifiant ou mauvais mot de passe ');
        }
      }
      else {
      throw new Exception ('Identifiant ou Mot de passe non saisi');
      }
    }
    public function adminArea($request){

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
    public function logout($request)
    {
      // Suppression des variables de session et de la session
      $_SESSION = array();
      session_destroy();

      $myView = new View('');
      $myView -> header();
      // header('Location:' . HOST);
    }

}
