<?php
session_start();
/** configuration **/
$root = $_SERVER['DOCUMENT_ROOT']; // D:/wamp64/www
$host = $_SERVER['HTTP_HOST']; // localhost



define ('HOST', 'http://' . $host .'/tests/Project-4-OC-BlogPhp/');
define ('ROOT', $root .'/tests/Project-4-OC-BlogPhp/');

define('CONTROLLER', ROOT. 'controller/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/controller/
define('VIEW', ROOT. 'view/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/view/
define('MODEL', ROOT. 'model/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/model/

define('ASSETS', HOST. 'assets/'); // localhost/tests/Project-4-OC-BlogPhp/assets/
