<?php
/*
Class Routeur
create routes and find controller
*/
class Routeur
{
    private $action;
    private $controller;
    private $routes = [
                          'chapter'          => array('controller' => 'Front', 'method' => 'chapter'),
                          'listChapters'     => array('controller' => 'Front', 'method' => 'listChapters'),
                          'addComment'       => array('controller' => 'Front', 'method' => 'addComment'),
                          'adminAuth'        => array('controller' => 'Front', 'method' => 'adminAuth'),
                          'checkPassword'    => array('controller' => 'Front', 'method' => 'checkPassword'),
                          'adminArea'        => array('controller' => 'Front', 'method' => 'adminArea'),
                          'logout'           => array('controller' => 'Front', 'method' => 'logout'),
                          'editChapter'      => array('controller' => 'Front', 'method' => 'editChapter'),
                          'sendEditChapter'  => array('controller' => 'Front', 'method' => 'sendEditChapter'),
                          'newChapter'       => array('controller' => 'Front', 'method' => 'newChapter'),
                          'sendNewChapter'   => array('controller' => 'Front', 'method' => 'sendNewChapter'),
                          'deleteChapter'    => array('controller' => 'Front', 'method' => 'deleteChapter')


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
      try{
            if(key_exists($this->action, $this->routes)) { // Ex : si chapter present dans routes[]
                $route = $this->routes[$this->action]; // $route = 'controller' => Front , 'method' => 'chapter'
                $controller = $route['controller']; // $ controller = Front
                $method     = $route['method'];  // $method = chapter
                $myController = new $controller($this->params); // $myController = new Front()
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
