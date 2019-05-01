<?php


  abstract class DbManager{

    private $db;

    public function __construct()
    {
      $db = new PDO('mysql:host=localhost;dbname=p4-oc;charset=utf8', 'root', '');
      $this->db = $db;
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

   // abstract public function getNameTable();
  }
