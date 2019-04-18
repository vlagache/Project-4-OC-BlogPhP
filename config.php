<?php
// session_start();
// /** configuration **/
// $root = $_SERVER['DOCUMENT_ROOT']; // D:/wamp64/www
// $host = $_SERVER['HTTP_HOST']; // localhost
//
//
//
// define ('HOST', 'http://' . $host .'/tests/Project-4-OC-BlogPhp/');
// define ('ROOT', $root .'/tests/Project-4-OC-BlogPhp/');
//
// define('CONTROLLER', ROOT. 'controller/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/controller/
// define('VIEW', ROOT. 'view/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/view/
// define('MODEL', ROOT. 'model/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/model/
// define('CLASSES', ROOT. 'classes/');
//
// define('ASSETS', HOST. 'assets/'); // localhost/tests/Project-4-OC-BlogPhp/assets/


class MyAutoload
{
  public static function start()
  {
    spl_autoload_register(array(__CLASS__, 'autoload'));
    session_start();
    $root = $_SERVER['DOCUMENT_ROOT']; // D:/wamp64/www
    $host = $_SERVER['HTTP_HOST']; // localhost



    define ('HOST', 'http://' . $host .'/tests/Project-4-OC-BlogPhp/');
    define ('ROOT', $root .'/tests/Project-4-OC-BlogPhp/');

    define('CONTROLLER', ROOT. 'controller/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/controller/
    define('VIEW', ROOT. 'view/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/view/
    define('MODEL', ROOT. 'model/'); // D:/wamp64/www/tests/Project-4-OC-BlogPhp/model/
    define('CLASSES', ROOT. 'classes/');

    define('ASSETS', HOST. 'assets/'); // localhost/tests/Project-4-OC-BlogPhp/assets/
  }
  public static function autoload($class)
  {
    if (file_exists(MODEL.$class.'.php'))
    {
       require_once (MODEL.$class.'.php');
    } else if (file_exists(CLASSES.$class.'.php'))
    {
      require_once (CLASSES.$class.'.php');
    } else if (file_exists(CONTROLLER.$class.'.php'))
    {
      require_once (CONTROLLER.$class.'.php');
    }
  }
}
