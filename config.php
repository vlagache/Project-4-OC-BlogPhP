<?php

class MyAutoload
{
  public static function start()
  {
    session_start();
    spl_autoload_register(array(__CLASS__, 'autoload'));
    $root = $_SERVER['DOCUMENT_ROOT']; // D:/wamp64/www
    $host = $_SERVER['HTTP_HOST']; // localhost

    $folder = '/tests/Project-4-OC-BlogPhP';
//     $folder = '/blog';

    define ('HOST', 'http://' . $host .$folder.'/');
    define ('ROOT', $root .$folder.'/');

    define('CONTROLLER', ROOT. 'controller/');
    define('VIEW', ROOT. 'view/');
    define('MODEL', ROOT. 'model/');
    define('CLASSES', ROOT. 'classes/');

    define('ASSETS', HOST. 'assets/');


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
