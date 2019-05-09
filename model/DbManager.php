<?php




  abstract class DbManager{

    private $db;

    public function __construct()
    {
      // $db = new PDO('mysql:host=db5000071771.hosting-data.io;dbname=dbs66372;charset=utf8', 'dbu226206', 'northtothefuture');
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
