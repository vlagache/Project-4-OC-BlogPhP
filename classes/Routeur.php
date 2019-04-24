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
                          'chapter'          => array('controller' => 'ChapterController', 'method' => 'chapter'),
                          'listChapters'     => array('controller' => 'ChapterController', 'method' => 'listChapters'),
                          'editChapter'      => array('controller' => 'ChapterController', 'method' => 'editChapter'),
                          'sendEditChapter'  => array('controller' => 'ChapterController', 'method' => 'sendEditChapter'),
                          'newChapter'       => array('controller' => 'ChapterController', 'method' => 'newChapter'),
                          'sendNewChapter'   => array('controller' => 'ChapterController', 'method' => 'sendNewChapter'),
                          'deleteChapter'    => array('controller' => 'ChapterController', 'method' => 'deleteChapter'),

                          /* ****************************** */

                          'addComment'       => array('controller' => 'CommentController', 'method' => 'addComment'),
                          'reportComment'    => array('controller' => 'CommentController', 'method' => 'reportComment'),
                          'approveComment'   => array('controller' => 'CommentController', 'method' => 'approveComment'),
                          'deleteComment'    => array('controller' => 'CommentController', 'method' => 'deleteComment'),

                          /* ****************************** */

                          'adminAuth'        => array('controller' => 'AdminController', 'method' => 'adminAuth'),
                          'checkPassword'    => array('controller' => 'AdminController', 'method' => 'checkPassword'),
                          'adminArea'        => array('controller' => 'AdminController', 'method' => 'adminArea'),
                          'logout'           => array('controller' => 'AdminController', 'method' => 'logout'),
                          'author'           => array('controller' => 'AdminController', 'method' => 'author')
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
