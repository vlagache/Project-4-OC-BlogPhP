<?php
/**
 * Class request
 *
 * create the request object with params & route ( $action)
 */
/*

Objet requet contient $action et les parametres
 */
class Request
{
  private $route;
  private $params;

  public function getRoute()
  {
    return $this->route;
  }
  public function setRoute($route)
  {
    $this->route = $route;
  }
  public function getParams()
  {
    return $this->params;
  }
  public function setParams($params)
  {
    $this->params = $params;
  }

  public function get($param)
  {
    if(!isset($this->params[$param])) return null;
    return $this->params[$param];
  }

}
