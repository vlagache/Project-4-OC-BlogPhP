<?php
class Chapter
{
  private $id;
  private $title;
  private $content;
  private $creation_date_fr;

  public function hydrate(array $datas)
  {
    foreach ($datas as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      if(method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }

  public function getId()
  {
    return $this->id;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function getContent()
  {
    return $this->content;
  }
  public function getCreation_date_fr()
  {
    return $this->creation_date_fr;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function setContent($content)
  {
    $this->content = $content;
  }
  public function setCreation_date_fr($creation_date_fr)
  {
    $this->creation_date_fr = $creation_date_fr;
  }
}
