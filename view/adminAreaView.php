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


  <div class="titleAdminArea">
    Chapitres
  </div>
  <table id="tableChapter">
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

  <div class="titleAdminArea">
    Commentaires
  </div>
  <div id="nbReportCom">
    Nombre de commentaires reportés par vos lecteurs : <?= $nbReportCom ?>
  </div>
  <table id="tableComment">
    <tr id="title">
      <th>Commentaire</th>
      <th>Posté le</th>
      <th>A propos du</th>
      <th>Auteur</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <?php foreach($comments as $comment): ?>
      <tr <?php if($comment->getReportCom() == 1 ):?>class="report" <?php endif ?>>
        <td class="commentTable"><?= $comment->getComment() ?></td>
        <td><?= $comment->getCommentDate()->format('d/m/Y') ?></td>
        <td class="titleCommentTable"><?= $comment->getTitle() ?></td>
        <td><?= $comment->getAuthor() ?></td>
        <td>
          <button type="button" class="approveComment">
            <a href="index.php?action=approveComment&amp;id=<?= $comment->getId() ?>"><i class="far fa-thumbs-up"></i></a>
          </button>
        </td>
        <td>
          <button type="button" class="deleteComment">
            <a href="index.php?action=deleteComment&amp;id=<?= $comment->getId() ?>">
            <i class="fas fa-times"></i></a>
          </button>
        </td>
      </tr>

    <?php endforeach ?>
  </table>

</div>



<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>                  
