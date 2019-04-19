<div id="adminArea">

  <div id="welcomeAdmin">
      Zone d'administration - connecté en tant que <?= $_SESSION['admin'] ?>
  </div>

  <!-- <div id="editMsg">
      <?= $editMsg ?>
  </div> -->

  <div id="writeNewChapter">
   <a href="index.php?action=newChapter">Ecrire un nouveau chapitre</a>
  </div>


  <table id="tableChapter">
    <div class="titleAdminArea">
      Chapitres
    </div>
    <tr id="title">
      <th>Titre</th>
      <th>Publié le</th>
      <th>Modifié le</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <?php foreach($chapters as $chapter): ?>
      <tr>
        <td><?= $chapter->getTitle() ?></td>
        <td><?= $chapter->getCreationDate()->format('d/m/Y') ?></td>
        <td><?= $chapter->getEditDate()->format('d/m/Y') ?></td>
        <td><a href="index.php?action=editChapter&amp;id=<?= $chapter->getId() ?>">Modifier</a></td>
        <td><a href="index.php?action=deleteChapter&amp;id=<?= $chapter->getId() ?>">Supprimer</a></td>
      </tr>
    <?php endforeach ?>
  </table>

  <table id="tableComment">
    <div class="titleAdminArea">
      Commentaires
    </div>
    <div id="nbReportCom">
      Nombre de commentaires reportés par vos lecteurs : <?= $nbReportCom ?>
    </div>
    <tr id="title">
      <th>Commentaire</th>
      <th>Posté le</th>
      <th>A propos du</th>
      <th>Auteur</th>
      <th>&nbsp;</th>
    </tr>
    <?php foreach($comments as $comment): ?>
      <tr <?php if($comment->getReportCom() == 1 ):?>class="report" <?php endif ?>>
        <td><?= $comment->getComment() ?></td>
        <td><?= $comment->getCommentDate()->format('d/m/Y') ?></td>
        <td><?= $comment->getTitle() ?></td>
        <td><?= $comment->getAuthor() ?></td>
        <td>Supprimer</td>
      </tr>
    <?php endforeach ?>
  </table>

</div>

<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>                  
