<?php
require_once(CONTROLLER.'frontend.php');
/*
Class Routeur
create routes and find controller
*/


class Routeur
{
    private $action;

    public function __construct($action)
    {
        $this->action = $action;
    }
    public function renderController()
    {
      try{
          if(isset($this->action)){
            if($this->action == 'listChapters'){
              listChapters();
            } elseif($this->action == 'chapter'){
               if(isset( $_GET['id']) &&  $_GET['id'] > 0){
                 chapter();
               } else{
                 throw new Exception('L\'identifiant du billet n\'éxiste pas ou ne correspond pas à un chapitre éxistant');
               }
            }
          } else {
            listChapters();
          }
      } catch(Exception $e) {
        $errorMessage = $e->getMessage();
        require('view/errorView.php');
      }
    }
}
