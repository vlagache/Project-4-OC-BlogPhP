<?php
class ChapterController {
    private $viewActive;


    public function __construct($params)
    {

      $this->viewActive = $params->getAction();
    }

  /**
   * [listChapters Send all chapters ]
   * @param  [type] $params [Request Object ]
   * @return [type]         [description]
   */
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
      $chapterEdit = $chapterManager->getChapter($params->getParam('id')); // Object Chapter


      $thumbnailController = new ThumbnailController();
      $nameImg = $thumbnailController->remplace($chapterEdit->getNameThumbnail(),$chapterEdit->getId());

      $chapterManager->updateChapter($params,$nameImg);
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

      $chapterManager = new ChapterManager();
      $thumbnailController = new ThumbnailController();

      $statusChapters = $chapterManager->showStatus('chapters');
      $nameImg = $thumbnailController->upload($statusChapters['Auto_increment']);

      $chapterManager->newChapter($params, $nameImg);

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
        $thumbnailController = new ThumbnailController();


        $chapterDelete = $chapterManager->getChapter($params->getParam('id')); // Objet Chapter
        $nameImgToDelete = $chapterDelete->getNameThumbnail(); // Nom de la miniature du chapitre à delete
        $thumbnailController->delete($nameImgToDelete); // Delete de la miniature

        $chapterManager->deleteChapter($params->getParam('id'));
        $commentManager->deleteAllComments($params->getParam('id'));



        header('Location: index.php?action=adminArea');
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
}
