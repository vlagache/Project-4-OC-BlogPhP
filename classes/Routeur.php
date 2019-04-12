<?php
require_once(CONTROLLER.'frontend.php');
require_once('classes/Request.php');
/*
Class Routeur
create routes and find controller
*/
class Routeur
{
    private $action;
    private $controller;
    private $routes = [
                          'chapter'          => array('controller' => 'Front', 'method' =>'chapter'),
                          'listChapters'     => array('controller' => 'Front', 'method' => 'listChapters'),
                          'addComment'       => array('controller' => 'Front', 'method' => 'addComment'),
                          'adminAuth'        => array('controller' => 'Front', 'method' => 'adminAuth'),
                          'checkPassword'    => array('controller' => 'Front', 'method' => 'checkPassword'),
                          'adminArea'        => array('controller' => 'Front', 'method' => 'adminArea'),
                          'logout'           => array('controller' => 'Front', 'method' => 'logout')
                          // ajouter les routes
                      ];
    private $params = array();

    public function __construct($action)
    {
        $this->action = $action;
        $this->params = new Request($this->action);
    }

    public function renderController()
    {
      //
      // echo '<pre>'; print_r($this->action);
      // echo '<pre>'; print_r($this->params); exit;

      try{
            if(key_exists($this->action, $this->routes)) { // Ex : si chapter present dans routes[]
                $route = $this->routes[$this->action]; // $route = 'controller' => Front , 'method' => 'chapter'
                $controller = $route['controller']; // $ controller = Front
                $method     = $route['method'];  // $method = chapter
                $myController = new $controller(); // $myController = new Front()
                $myController->$method($this->params);  // $myController -> chapter($params)
            } else {
              throw new Exception('Page inexistante');
            }
          } catch(Exception $e) {
            // $myController = new Front();
            // $viewActive = $myController -> menuActive($this->params);
            $viewActive = '';
            $errorMessage = $e->getMessage();
            require('view/errorView.php');
          }

    }
}


/*


    public function renderController()
    {

      $controller = $this->controller;

      try{
          if(isset($this->action)){
            if($this->action == 'listChapters'){
              $controller->listChapters();
            } elseif($this->action == 'chapter'){
               if(isset( $_GET['id']) &&  $_GET['id'] > 0){
                $controller->chapter();
               } else{
                 throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
               }
            } elseif($this->action == 'addComment'){
              if(isset($_GET['id']) && $_GET['id'] > 0){
                if(!empty($_POST['author']) && !empty($_POST['comment'])){
                  $controller->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                  throw new Exception('Tous les champs ne sont pas remplis !');
                }
              } else {
                throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
              }
            }
          } else {
            $controller->listChapters();
          }
      } catch(Exception $e) {
        $errorMessage = $e->getMessage();
        require('view/errorView.php');
      }
    }
    */
