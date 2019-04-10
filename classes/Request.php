<?php
/*
Class Request
stores & return $_GET , $_POST , $_COOKIE ( = $_REQUEST) []

*/

class Request
{
  private $request;

  public function __construct()
  {
      $this->request = $_REQUEST;
  }

  public function getParams($id)
  {
    if(!isset($this->request[$id])) return null;
    return $this->request[$id];
  }
}
