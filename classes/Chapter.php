<?php
class Chapter
{
  private $id;
  private $title;
  private $content;
  private $creation_date;


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
  public function getNextId()
  {
    $id  = $this->id;
    $id++;
    return $id;
  }
  public function getPreviousId()
  {
    $id  = $this->id;
    $id--;
    return $id;
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
    $this->title = htmlspecialchars($title);
  }
  public function getContent()
  {
    return $this->content;
  }
  public function setContent($content)
  {
    $this->content = nl2br(htmlspecialchars($content));
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
  public function getResumeContent($param = 300) {
    $this->setContent(substr($this->content,0,$param));
    return $this->getContent();
  }
}
