<?php

require_once(MODEL.'DbManager.php');
require_once('classes/Comment.php');


class CommentManager extends DbManager {


  // Return 5 last comments
  public function getLastComments()
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT com.chapter_id,com.author, com.comment, com.comment_date,chap.title FROM chapters chap INNER JOIN comments com ON com.chapter_id = chap.id ORDER BY com.comment_date DESC ');
    $req -> execute();

    $comments = array();

    while($data = $req->fetch(PDO::FETCH_ASSOC)){
      $comment = new Comment();

      $comment->hydrate($data);
      $comment->setTitle($data['title']);

      $comments[] = $comment;

    }

    return $comments;
  }
  //Return all comments of a chapter
  public function getComments($chapterId)
  {
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, author, comment, comment_date FROM comments WHERE chapter_id = ? ORDER BY comment_date DESC');
    $req->execute(array($chapterId));

    $comments = array();
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
      $comment = new Comment();
      $comment->hydrate($data);
      $comments[] = $comment;
    }
    return $comments;
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
