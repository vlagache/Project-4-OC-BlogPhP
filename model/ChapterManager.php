<!-- Modele de récuperation des données pour la partie Article
Function qui permettent de récuperer un article ou tout les articles -->

<?php
require_once(MODEL.'DbManager.php');
require_once('classes/Chapter.php');


class ChapterManager extends DbManager {
  // Renvoie tout les chapitres
  public function getChapters(){
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, creation_date FROM chapters ORDER BY creation_date DESC');
    $req->execute();

    $chapters = array();
    while($data = $req->fetch(PDO::FETCH_ASSOC)) {
      $chapter = new Chapter();
      $chapter->hydrate($data);
      $chapters[] = $chapter;
    }

    return $chapters;
  }
  // Renvoie un chapitre en fonction de son ID
  public function getChapter($chapterId){
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, creation_date FROM chapters WHERE id = ?');
    $req->execute(array($chapterId));
    $data = $req->fetch(PDO::FETCH_ASSOC);

    if (!empty($data) ) // si la requete est bien executé différent de si la requete est vide.
    {
      $chapter = new Chapter();
      $chapter->hydrate($data);
      return $chapter;
    } else {
      throw new Exception('Chapitre inexistant');
    }
  }

}
