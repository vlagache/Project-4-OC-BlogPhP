<?php
class CommentManager extends DbManager {


  // Return 5 last comments
  public function getLastComments()
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT com.id, com.chapter_id, com.author, com.comment, com.comment_date, com.report_com, com.hidden_com, com.hidden_by, com.hidden_date, chap.title FROM chapters chap INNER JOIN comments com ON com.chapter_id = chap.id ORDER BY com.comment_date DESC ');
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
    $req = $db->prepare('SELECT id, chapter_id, author, comment, comment_date, hidden_com FROM comments WHERE chapter_id = ? ORDER BY comment_date DESC');
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
    $req = $db->prepare('INSERT INTO comments (chapter_id, author, comment, comment_date, report_com, hidden_com) VALUES(?, ?, ?, NOW(), 0, 0)');
    $affectedLines = $req->execute(array($chapterId, $author, $comment));
    return $affectedLines;
  }

  /**
   * [nbReportCom description]
   * @return [type] [description]
   */
  public function nbReportCom()
  {
    $db=$this->dbConnect();
    $req = $db->prepare('  SELECT COUNT(*) AS nbReportCom FROM comments WHERE report_com = 1');
    $req->execute();
    $nbReportCom = $req->fetch(PDO::FETCH_ASSOC);
    return $nbReportCom['nbReportCom'];
  }
  public function setReportCom($commentId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET report_com = 1 WHERE id = ? ');
    $req->execute(array($commentId));
  }
  public function unsetReportCom($commentId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET report_com = 0 WHERE id = ? ');
    $req->execute(array($commentId));
  }
  public function hiddenComment($commentId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET hidden_com = 1, report_com = 0, hidden_by = ?, hidden_date = NOW() WHERE id = ?');
    $req->execute(array($_SESSION['admin'], $commentId));
  }
  public function restoreComment($commentId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET hidden_com = 0, hidden_by = NULL, hidden_date = NULL WHERE id = ?');
    $req->execute(array($commentId));
  }
  public function deleteComment($commentId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM comments WHERE id = ?');
    $req->execute(array($commentId));
  }

  // public function deleteComment($table,$commentId)
  // {
  //   $this->delete($table,$commentId);
  // }
  //
}
