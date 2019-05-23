<?php
class ChapterController {
    private $viewActive;


    public function __construct($request)
    {

      $this->viewActive = $request->getRoute();
    }

  /**
   * [listChapters Send all chapters ]
   * @param  [type] $request [Request Object ]
   * @return [type]         [description]
   */
    public function listChapters($request)
    {
      $chapterManager = new ChapterManager();
      $chapters = $chapterManager->getChapters();




      $title = 'Billet simple pour l\'Alaska par Jean Forteroche';
      $myView = new View('home');
      $myView->render(array('chapters' => $chapters, 'title' => $title, 'viewActive' => $this->viewActive));
    }

    public function chapter($request)
    {

      if (!null == $request->get('id') && $request->get('id') > 0 )
      {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();


        $chapter = $chapterManager->getChapter($request->get('id'));

        if ($chapter->getTrashChapter() == 0)
        {
          $chapters = $chapterManager->getChapters(); // Footer
          $comments = $commentManager->getComments($request->get('id'));

          $title = $chapter->getTitle();
          $myView = new View('chapterView');
          $myView->render(array('chapter' => $chapter, 'chapters' => $chapters, 'comments' => $comments, 'title' => $title, 'viewActive' => $this->viewActive));
        } else
        {
          throw new Exception('Ce chapitre n\'existe plus !');
        }

      } else {
        throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
      }
    }
    public function editChapter($request)
    {
      if (isset($_SESSION['admin']))
      {
        if (!null == $request->get('id') && $request->get('id') > 0 )
        {
          $chapterManager = new ChapterManager();

          $chapter = $chapterManager->getChapter($request->get('id'));
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
    public function sendEditChapter($request)
    {

      $chapterManager = new ChapterManager();
      $chapterEdit = $chapterManager->getChapter($request->get('id')); // Object Chapter


      $thumbnailController = new ThumbnailController();
      if(!$nameImg =$thumbnailController->remplace($chapterEdit->getNameThumbnail(),$chapterEdit->getId())) $nameImg = $chapterEdit->getNameThumbnail();




      $chapterManager->updateChapter($request,$nameImg);
      $myView = new View('adminArea');
      $myView -> header();
    }

    public function newChapter($request)
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
    public function sendNewChapter($request)
    {

      $chapterManager = new ChapterManager();
      $thumbnailController = new ThumbnailController();

      $statusChapters = $chapterManager->showStatus('chapters');
      $nameImg = $thumbnailController->upload($statusChapters['Auto_increment']);

      $chapterManager->newChapter($request, $nameImg);

      $myView = new View('adminArea');
      $myView -> header();
    }
    public function trashChapter($request)
    {
      if (isset($_SESSION['admin']))
      {
        $chapterManager = new ChapterManager();
        $chapterManager->trashChapter($request->get('id'));
        $myView = new View('adminArea');
        $myView -> header();
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
    public function restoreChapter($request)
    {
      if (isset($_SESSION['admin']))
      {
        $chapterManager = new ChapterManager();
        $chapterManager->restoreChapter($request->get('id'));
        $myView = new View('adminArea');
        $myView -> header();
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
    public function deleteChapter($request)
    {
      if (isset($_SESSION['admin']))
      {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();
        $thumbnailController = new ThumbnailController();


        $chapterDelete = $chapterManager->getChapter($request->get('id')); // Objet Chapter
        $nameImgToDelete = $chapterDelete->getNameThumbnail(); // Nom de la miniature du chapitre à delete
        $thumbnailController->delete($nameImgToDelete); // Delete de la miniature

        $chapterManager->deleteChapter($request->get('id'));
        $commentManager->deleteAllComments($request->get('id'));



        $myView = new View('adminArea');
        $myView -> header();
      } else
      {
        throw new Exception('Acces non autorisé ');
      }
    }
}
