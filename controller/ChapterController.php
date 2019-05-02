<?php
class ChapterController {
    private $viewActive;


    public function __construct($params)
    {

      $this->viewActive = $params->getAction();
    }

    // Tout les chapitres
    public function listChapters($params)
    {
      $chapterManager = new ChapterManager();
      $chapters = $chapterManager->getChapters();




      $title = 'Billet simple pour l\'Alaska par Jean Forteroche';
      $myView = new View('home');
      $myView->render(array('chapters' => $chapters, 'title' => $title, 'viewActive' => $this->viewActive));
    }

    public function chapter($params)
    {

      if (!null == $params->getParam('id') && $params->getParam('id') > 0 )
      {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();


        $chapter = $chapterManager->getChapter($params->getParam('id'));
        $chapters = $chapterManager->getChapters(); // Footer
        $comments = $commentManager->getComments($params->getParam('id'));

        $title = $chapter->getTitle();
        $myView = new View('chapterView');
        $myView->render(array('chapter' => $chapter, 'chapters' => $chapters, 'comments' => $comments, 'title' => $title, 'viewActive' => $this->viewActive));
      } else {
        throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
      }
    }
    public function editChapter($params)
    {
      if (isset($_SESSION['admin']))
      {
        if (!null == $params->getParam('id') && $params->getParam('id') > 0 )
        {
          $chapterManager = new ChapterManager();

          $chapter = $chapterManager->getChapter($params->getParam('id'));
          $chapters = $chapterManager->getChapters();


          $title = 'Edition de : ' . $chapter->getTitle();
          $myView = new View('editChapterView');
          $myView->render(array('chapter' => $chapter, 'chapters' => $chapters, 'title' => $title, 'viewActive' => $this->viewActive));
        } else {
          throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
        }
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
    public function sendEditChapter($params)
    {
      $chapterManager = new ChapterManager();
      $chapterManager->updateChapter($params);
      header('Location: index.php?action=adminArea');
    }

    public function newChapter($params)
    {
      if (isset($_SESSION['admin']))
      {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();

        $title = ' Création d\'un nouveau chapitre ';
        $myView = new View('newChapterView');
        $myView->render(array('chapters' => $chapters, 'title' => $title, 'viewActive' => $this->viewActive));
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
    public function sendNewChapter($params)
    {

      // echo $_FILES['thumbnail']['name']; // ex  : road2-alaska.jpg
      // echo ' /type// ' . $_FILES['thumbnail']['type']; // ex : image/jpg
      // echo ' /size// ' . $_FILES['thumbnail']['size']; : // ex : 455796 ( ko )
      // echo ' /tmp_name// ' . $_FILES['thumbnail']['tmp_name']; // addresse du fichier temporaire
      // echo ' /error// ' . $_FILES['thumbnail']['error']; // code erreur , 0 si tout est bon
      // exit;
      $chapterManager = new ChapterManager();
      $statusChapters = $chapterManager->showStatus('chapters');


      if ($_FILES['thumbnail']['error'] > 0 )
      {
        throw new Exception('Erreur lors du chargement de la miniature');
      } else
      {
        $name = basename($_FILES["thumbnail"]["name"]); // alaskaMiniature.jpg
        $elements = explode('.',$name); // alaskaMiniature & jpg
        $elements[0] .= $statusChapters['Auto_increment']; // alaskaMiniature10
        $nameUpFile = implode('.',$elements); // alaskaMiniature10.jpg


        $tmp_name = $_FILES['thumbnail']['tmp_name'];
        $destination = 'assets/images/thumbnails';

        move_uploaded_file($tmp_name,$destination . '/' . $nameUpFile);
        $chapterManager->newChapter($params, $nameUpFile);
      }
      header('Location: index.php?action=adminArea');
    }
    public function trashChapter($params)
    {
      if (isset($_SESSION['admin']))
      {
        $chapterManager = new ChapterManager();
        $chapterManager->trashChapter($params->getParam('id'));
        header('Location: index.php?action=adminArea');
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
    public function restoreChapter($params)
    {
      if (isset($_SESSION['admin']))
      {
        $chapterManager = new ChapterManager();
        $chapterManager->restoreChapter($params->getParam('id'));
        header('Location: index.php?action=adminArea');
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
    public function deleteChapter($params)
    {
      if (isset($_SESSION['admin']))
      {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();

        $chapterManager->deleteChapter($params->getParam('id'));
        $commentManager->deleteAllComments($params->getParam('id'));
        header('Location: index.php?action=adminArea');
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
}
