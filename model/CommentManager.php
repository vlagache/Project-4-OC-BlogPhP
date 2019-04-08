<?php

require_once(MODEL.'DbManager.php');


class CommentManager extends DbManager {


  // Return 5 last comments & title chapter
  public function getLastComments()
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT com.chapter_id,com.author, com.comment, DATE_FORMAT(com.comment_date,\'%d/%m/%Y\') AS comment_date_fr, chap.title FROM chapters chap INNER JOIN comments com ON com.chapter_id = chap.id ORDER BY com.comment_date DESC LIMIT 0,5 ');
    $req -> execute();
    return $req;
  }
  //Return all comments of a chapter
  public function getComments($chapterId)
  {
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE chapter_id = ? ORDER BY comment_date DESC');
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
