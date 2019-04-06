<?php

require_once(MODEL.'DbManager.php');


class CommentManager extends DbManager {
  // Return all comments
  public function getComments($chapterId)
  {
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE chapter_id = ? ORDER BY comment_date DESC');
    $req->execute(array($chapterId));

    return $req;
  }
  // Post a comment in DB
  public function postComment($chapterId, $author, $comment)
  {
    $db=$this->dbConnect();
    $req = $db->prepare('INSERT INTO comments (chapter_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $req->execute(array($chapterId, $author, $comment));
    return $affectedLines;
  }







}
