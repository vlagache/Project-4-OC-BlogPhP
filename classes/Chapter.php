<?php

class Chapter
{
  private $id;
  private $nextId;
  private $previousId;
  private $title;
  private $content;
  private $creation_date;
  private $edit_date;


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

  public function setNextId($nextId)
  {
    $this->nextId = $nextId;
  }

  public function getNextId()
  {
    return $this->nextId;
  }
  public function setPreviousId($previousId)
  {
    $this->previousId = $previousId;
  }
  public function getPreviousId()
  {
    return $this->previousId;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function getContent()
  {
    return $this->content;
  }
  public function setContent($content)
  {
    $this->content = $content;
  }
  public function getCreationDate()
  {
    return $this->creation_date;
  }
  public function setCreationDate($creation_date)
  {
    $date = new DateTime($creation_date);
    $this->creation_date = $date;
  }
  public function getEditDate()
  {
    return $this->edit_date;
  }
  public function setEditDate($edit_date)
  {
    $date = new DateTime($edit_date);
    $this->edit_date = $date;
  }
  public function getResumeContent($param = 300) {
    $this->setContent(substr($this->content,0,$param));
    return $this->getContent();
  }
}
