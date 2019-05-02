<?php
require_once('config.php');
MyAutoLoad::start();

$commentManager = new CommentManager();
$comments = $commentManager->getLastComments(); // Array d'objet Comment

$array_comments = array();

foreach($comments as $comment)
{
  if ($comment->getHiddenCom() == 0 )
  {
    $array_comment = array('author' => $comment->getAuthor(), 'comment' => $comment->getResumeComment());
    array_push($array_comments, $array_comment);
  }
}

echo json_encode($array_comments, JSON_PRETTY_PRINT);
