<?php

class ApiController
{
  public function displayComment()
  {
    $commentManager = new CommentManager();
    $comments = $commentManager->getLastComments(); // Array d'objet Comment

    $array_comments = array();


    foreach($comments as $comment)
    {
      if ($comment->getHiddenCom() == 0 )
      {
        $array_comment = array('author' => $comment->getAuthor(), 'comment' => $comment->getResumeComment(), 'commentDate' => $comment->getCommentDate()->format('d/m/Y à H:i'));
        array_push($array_comments, $array_comment);
      }
    }

    echo json_encode($array_comments, JSON_PRETTY_PRINT);

  }
}
