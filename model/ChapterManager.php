<!-- Modele de récuperation des données pour la partie Article
Function qui permettent de récuperer un article ou tout les articles -->

<?php
require_once('model/DbManager.php');


class ChapterManager extends DbManager {
  // Renvoie tout les chapitres
  public function getChapters(){
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, title, SUBSTR(content,1,300) AS resume_content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC');
    $req->execute();

    return $req;
  }
  // Renvoie un chapitre en fonction de son ID
  public function getChapter($chapterId){
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters WHERE id = ?');
    $req->execute(array($chapterId));
    $chapter = $req->fetch();

    return $chapter;
  }
  // Renvoie le nombre de chapitres
  public function getCountChapters(){
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT COUNT(id) from chapters');
    $req->execute();

    return $req;
  }
}
