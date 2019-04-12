<?php
/*
Class Request
stores & return $_GET , $_POST , $_COOKIE ( = $_REQUEST) []

*/

class Request
{
  private $action;
  private $request;

  public function __construct($action)
  {
      $this->action = $action;
      $this->request = $_REQUEST;
  }

  public function getParam($id)
  {
    if(!isset($this->request[$id])) return null;
    return $this->request[$id];
  }
  public function getAction()
  {
    return $this->action;
  }
}
