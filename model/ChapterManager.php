<!-- Modele de récuperation des données pour la partie Article
Function qui permettent de récuperer un article ou tout les articles -->

<?php
class ChapterManager extends DbManager
{
  // Renvoie tout les chapitres
  public function getChapters()
  {
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, creation_date, edit_date, trash_chapter, name_thumbnail FROM chapters ORDER BY creation_date DESC');
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
  public function getChapter($chapterId)
  {
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, creation_date, edit_date FROM chapters WHERE id = ?');
    $req->execute(array($chapterId));
    $data = $req->fetch(PDO::FETCH_ASSOC);

    if (!empty($data) ) // si la requete est bien executé différent de si la requete est vide.
    {
      $chapter = new Chapter();
      $chapter->hydrate($data);
      $chapter->setNextId($this->getNextId($chapterId));
      $chapter->setPreviousId($this->getPreviousId($chapterId));
      return $chapter;
    } else {
      throw new Exception('Chapitre inexistant');
    }
  }

  /**
   * [getNextId Returns the id of the next chapter who is not in the trash ]
   * @param  [int] $chapterId [description]
   * @return [string|null] $data['id'] [description]
   */
  public function getNextId(Int $chapterId) {
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id FROM chapters WHERE id > ? AND trash_chapter = 0 ORDER BY id ASC  LIMIT 1');
    $req->execute(array($chapterId));
    if(!$data =  $req->fetch(PDO::FETCH_ASSOC)) return null;
    return $data['id'];
  }
  /**
   * [getPreviousId Returns the id of thes next chapter who is not in the trash ]
   * @param  Int    $chapterId [description]
   * @return [string|null]            [description]
   */
  public function getPreviousId(Int $chapterId)
  {
    $db=$this->dbConnect();
    $req = $db->prepare('SELECT id FROM chapters WHERE id < ? AND trash_chapter = 0 ORDER BY id DESC LIMIT 1');
    $req->execute(array($chapterId));
    if(!$data =  $req->fetch(PDO::FETCH_ASSOC)) return null;
    return $data['id'];
  }

  public function updateChapter(Request $params)
  {
    $db=$this->dbConnect();
    $req = $db->prepare('UPDATE chapters SET content = ? , title = ? , edit_date = NOW()  WHERE id = ?');
    $req->execute(array($params->getParam('tinyMceContent'),$params->getParam('titleChapter'),$params->getParam('id')));

  }

  public function newChapter($params, $nameUpFile)
  {

      $db = $this->dbConnect();
      $req = $db->prepare('INSERT INTO chapters(title, content, creation_date, edit_date, trash_chapter, name_thumbnail) VALUES(?, ?, NOW(), NULL, 0, ?) ');
      $req->execute(array($params->getParam('titleChapter'), $params->getParam('tinyMceContent'), $nameUpFile));
  }
  public function trashChapter($chapterId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE chapters SET trash_chapter = 1 WHERE id = ?');
    $req->execute(array($chapterId));

  }
  public function restoreChapter($chapterId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE chapters SET trash_chapter = 0 WHERE id = ?');
    $req->execute(array($chapterId));

  }
  public function deleteChapter($chapterId)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM chapters WHERE id = ?');
    $req->execute(array($chapterId));

  }
  public function showStatus($name)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SHOW TABLE STATUS WHERE name = ?');
    $req->execute(array($name));
    $data = $req->fetch(PDO::FETCH_ASSOC);

    return $data;

  }
  //
  // public function deleteChapter($table,$chapterId)
  // {
  // //   $this->delete($table,$chapterId);
  // }
}
