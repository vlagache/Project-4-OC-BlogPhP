<!-- Routeur -->
<?php


require('controller/frontend.php');
require_once('model/ChapterManager.php');
require_once('classes/Routeur.php');

$action = $_GET['action'];

$routeur = new Routeur($action);
$routeur->renderController();
