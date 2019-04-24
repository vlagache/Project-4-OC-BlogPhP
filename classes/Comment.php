<?php
class comment
{
  private $id;
  private $chapter_id;
  private $author;
  private $comment;
  private $comment_date;
  private $chapter_name;
  private $report_com;
  private $delete_com;


  public function hydrate(array $datas)
  {
    foreach ($datas as $key => $value)
    {
      $elements = explode('_', $key); // Ex : creation_date => creation & date
      $method = 'set';
      foreach($elements as $e) {
        $method .= ucfirst($e); // setCreationDate
      }
      if(method_exists($this, $method))
      {
        $this->$method($value); // setCreationDate($date);
      }
    }
  }

  public function getId()
  {
    return $this->id;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getChapterId()
  {
    return $this->chapter_id;
  }
  public function setChapterId($chapter_id)
  {
    $this->chapter_id = $chapter_id;
  }
  public function getAuthor()
  {
    return $this->author;
  }
  public function setAuthor($author)
  {
    $this->author = htmlspecialchars($author);
  }
  public function getComment()
  {
    return $this->comment;
  }
  public function setComment($comment)
  {
    $this->comment = nl2br(htmlspecialchars($comment));
  }
  public function getCommentDate()
  {
    return $this->comment_date;
  }
  public function setCommentDate($comment_date)
  {
    $date = new DateTime($comment_date);
    $this->comment_date = $date;
  }
  public function getTitle()
  {
    return $this->chapter_name;
  }
  public function setTitle($chapter_name)
  {
    $this->chapter_name = $chapter_name;
  }
  public function getReportCom()
  {
    return $this->report_com;
  }
  public function setReportCom($report_com)
  {
    $this->report_com = $report_com;
  }
  public function getDeleteCom()
  {
    return $this->delete_com;
  }
  public function setDeleteCom($delete_com)
  {
    $this->delete_com = $delete_com;
  }
}
