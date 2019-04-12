<?php

require_once(MODEL.'DbManager.php');

class AdminManager extends DbManager
{
  public function getAdmin($login)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, login, password FROM admin WHERE login = ?');
    $req ->execute(array($login));

    $admin = $req->fetch();

    return $admin;

  }
}
