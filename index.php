
<?php

require_once('config.php');
require('classes/Routeur.php');


if(isset($_GET['action'])){
  $action = $_GET['action'];
} else {
  $action = 'listChapters';
}


$routeur = new Routeur($action);
$routeur->renderController();
