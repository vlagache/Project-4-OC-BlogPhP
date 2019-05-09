<?php

class CommentController{
  private $viewActive;

  public function __construct($request)
  {

    $this->viewActive = $request->getRoute();
  }

  public function addComment($request){
    if (!null == $request->get('id') && $request->get('id') > 0 )
    {
      if(!null == $request->get('author') && !null == $request->get('comment'))
      {
        $commentManager = new CommentManager();
        $affectedLines = $commentManager ->postComment($request->get('id'), $request->get('author'), $request->get('comment'));

        if ($affectedLines === false) {
          throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {

          $myView = new View('chapter/id/'.$request->get('id'));
          $myView -> header();
            // header('Location: ' . HOST . 'chapter/id/' . $request->get('id'));
        }

      } else {
        throw new Exception('Tous les champs ne sont pas remplis !');
      }
    } else {
      throw new Exception ('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
    }
  }
  public function reportComment($request)
  {
    $commentManager = new CommentManager();
    $commentManager->setReportCom($request->get('idCom'));
    $myView = new View('chapter/id/'.$request->get('id'));
    $myView -> header();
  }
  public function approveComment($request)
  {
    if (isset($_SESSION['admin']))
    {
      $commentManager = new CommentManager();
      $commentManager->unsetReportCom($request->get('id'));
      $myView = new View('adminArea');
      $myView -> header();
    } else {
      throw new Exception('Acces non autorisé ');
    }
  }
  public function hiddenComment($request)
  {
    if (isset($_SESSION['admin']))
    {
      $commentManager = new CommentManager();
      $commentManager->hiddenComment($request->get('id'));
      $myView = new View('adminArea');
      $myView -> header();
    } else {
      throw new Exception('Acces non autorisé ');
    }
  }
  public function restoreComment($request)
  {
    if (isset($_SESSION['admin']))
    {
      $commentManager = new CommentManager();
      $commentManager->restoreComment($request->get('id'));
      $myView = new View('adminArea');
      $myView -> header();
    } else {
      throw new Exception('Acces non autorisé');
    }
  }
  public function deleteComment($request)
  {
    if (isset($_SESSION['admin']))
    {
      $commentManager = new CommentManager();
      $commentManager->deleteComment($request->get('id'));
      $myView = new View('adminArea');
      $myView -> header();
    } else {
      throw new Exception('Acces non autorisé');
    }
  }
}
