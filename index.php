<!-- Routeur -->
<?php

require_once('config.php');
require('classes/Routeur.php');

$action = $_GET['action'];




$routeur = new Routeur($action);
$routeur->renderController();
