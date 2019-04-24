<?php

class CommentController{
  private $viewActive;

  public function __construct($params)
  {

    $this->viewActive = $params->getAction();
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
  public function reportComment($params)
  {
    $commentManager = new CommentManager();
    $commentManager->setReportCom($params->getParam('idCom'));
    header('Location: index.php?action=chapter&id=' . $params->getParam('id'));
  }
  public function approveComment($params)
  {
    if (isset($_SESSION['admin']))
    {
      $commentManager = new CommentManager();
      $commentManager->unsetReportCom($params->getParam('id'));
      header('Location: index.php?action=adminArea');
    } else {
      throw new Exception('Acces non autorisé ');
    }
  }
  public function deleteComment($params)
  {
    if (isset($_SESSION['admin']))
    {
      $commentManager = new CommentManager();
      $commentManager->deleteComment($params->getParam('id'));
      header('Location: index.php?action=adminArea');
    } else {
      throw new Exception('Acces non autorisé ');
    }
  }

}
