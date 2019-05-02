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
  private $hidden_com;
  private $hidden_by;
  private $hidden_date;


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
  public function getHiddenCom()
  {
    return $this->hidden_com;
  }
  public function setHiddenCom($hidden_com)
  {
    $this->hidden_com = $hidden_com;
  }
  public function getHiddenBy()
  {
    return $this->hidden_by;
  }
  public function setHiddenBy($hidden_by)
  {
    $this->hidden_by = $hidden_by;
  }
  public function getHiddenDate()
  {
    return $this->hidden_date;
  }
  public function setHiddenDate($hidden_date)
  {
    $date = new DateTime($hidden_date);
    $this->hidden_date = $date;
  }
  public function getResumeComment($param = 350)
  {
    if(strlen($this->comment) > $param)
    {
      $this->setComment(substr($this->comment,0,$param)); //
      $this->comment = $this->comment . ' [...]';
      return $this->getComment();
    } else {
      return $this->getComment();
    }
  }
}
