<?php
  abstract class DbManager{

    private $db;

    public function __construct()
    {
      $configDb = parse_ini_file("config.ini");
      $loginDb = $configDb['dblogin'];
      $passwordDb = $configDb['dbpassword'];
      $dbname = $configDb['dbname'];

      $db = new PDO("mysql:host=localhost;dbname={$dbname};charset=utf8", $loginDb, $passwordDb);

      $this->db = $db;;

    }

    protected function dbConnect()
    {
      return $this->db;
    }

    protected function delete($table, $id)
    {
      $db = $this->db;
      $req = $db->prepare('DELETE FROM ? WHERE id = ? ');
      $req->execute(array($table,$id));
    }
  }
