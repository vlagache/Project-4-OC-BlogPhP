<?php
/*
Class Routeur
create routes and find controller
*/
class Routeur
{
    private $action; // url ex chapter/id/25
    private $controller;
    private $routes = [
                          'chapter'          => array('controller' => 'ChapterController', 'method' => 'chapter'),
                          'listChapters'     => array('controller' => 'ChapterController', 'method' => 'listChapters'),
                          'editChapter'      => array('controller' => 'ChapterController', 'method' => 'editChapter'),
                          'sendEditChapter'  => array('controller' => 'ChapterController', 'method' => 'sendEditChapter'),
                          'newChapter'       => array('controller' => 'ChapterController', 'method' => 'newChapter'),
                          'sendNewChapter'   => array('controller' => 'ChapterController', 'method' => 'sendNewChapter'),
                          'trashChapter'     => array('controller' => 'ChapterController', 'method' => 'trashChapter'),
                          'restoreChapter'   => array('controller' => 'ChapterController', 'method' => 'restoreChapter'),
                          'deleteChapter'    => array('controller' => 'ChapterController', 'method' => 'deleteChapter'),

                          /* ****************************** */

                          'addComment'       => array('controller' => 'CommentController', 'method' => 'addComment'),
                          'reportComment'    => array('controller' => 'CommentController', 'method' => 'reportComment'),
                          'approveComment'   => array('controller' => 'CommentController', 'method' => 'approveComment'),
                          'hiddenComment'    => array('controller' => 'CommentController', 'method' => 'hiddenComment'),
                          'restoreComment'   => array('controller' => 'CommentController', 'method' => 'restoreComment'),
                          'deleteComment'    => array('controller' => 'CommentController', 'method' => 'deleteComment'),

                          /* ****************************** */

                          'adminAuth'        => array('controller' => 'AdminController', 'method' => 'adminAuth'),
                          'checkPassword'    => array('controller' => 'AdminController', 'method' => 'checkPassword'),
                          'adminArea'        => array('controller' => 'AdminController', 'method' => 'adminArea'),
                          'logout'           => array('controller' => 'AdminController', 'method' => 'logout'),
                          'author'           => array('controller' => 'AdminController', 'method' => 'author'),

                          'displayComment' =>   array('controller' => 'ApiController', 'method' => 'displayComment')
                          // ajouter les routes
                      ];


    public function __construct($action)
    {
        $this->action = $action;

        $route = $this->getRoute();
        $params = $this->getParams();

        // $this->params = new Request($this->action);
        $request = new Request();
        $request->setRoute($route);
        $request->setParams($params);

        $this->request = $request;

    }
    public function getRoute()
    {
      $elements = explode('/',$this->action);
      return $elements[0]; // ex $action = chapter/30/25 ; return chapter;
    }
    public function getParams()
    {
      $params = array();
      // extract GET Params
      $elements = explode('/',$this->action);
      unset($elements[0]);

      for($i = 1; $i<count($elements); $i++)
      {
          $params[$elements[$i]] = $elements[$i+1];
          $i++;
      }
      // extract POST params
      if($_POST)
      {
          foreach($_POST as $key => $val)
          {
              $params[$key] = $val;
          }
      }
      return $params;
    }


    public function renderController()
    {
      try{

            $request = $this->request;

            if(key_exists($request->getRoute(), $this->routes)) { // Ex : si chapter present dans routes[]
                $route = $this->routes[$request->getRoute()]; // $route = 'controller' => Front , 'method' => 'chapter'
                $controller = $route['controller']; // $ controller = Front
                $method     = $route['method'];  // $method = chapter
                $myController = new $controller($request); // $myController = new Front()
                $myController->$method($request);  // $myController -> chapter($params)
            } else {
              throw new Exception('Page inexistante');
            }
          } catch(Exception $e) {
            $viewActive = '';
            $chapterManager = new ChapterManager();
            $chapters = $chapterManager->getChapters(); // Footer

            $errorMessage = $e->getMessage();

            $title = 'Une erreur est survenue';
            $myView = new View('errorView');
            $myView->render(array('title' => $title, 'errorMessage' => $errorMessage, 'chapters' => $chapters, 'viewActive' => $viewActive));

          }

    }
}
