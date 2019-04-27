<div id="adminArea">
  <div class="container">

    <h3>Zone d'administration - <?= $_SESSION['admin'] ?></h3>


    <!-- <div id="editMsg">
        <?= $editMsg ?>
    </div> -->

    <a href="index.php?action=newChapter" class="waves-effect waves-light btn-small"><i class="material-icons right">edit</i>Ecrire un nouveau chapitre</a>

    <h4>Chapitres</h4>

    <table class="hilight responsive-table">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Publié le</th>
          <th>Modifié le</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </thead>

      <tbody>
        <?php $i = 1 ?>
        <?php foreach($chapters as $chapter): ?>
          <tr>
            <td><?= $chapter->getTitle() ?></td>
            <td><?= $chapter->getCreationDate()->format('d/m/Y') ?></td>
            <td><?= $chapter->getEditDate()->format('d/m/Y') ?></td>
            <td>
              <a href="index.php?action=editChapter&amp;id=<?= $chapter->getId() ?>" class="btn-floating teal lighten-1">
                <i class="material-icons">edit</i>
              </a>
            </td>
            <td>
              <!-- Modal Trigger -->
              <a class="modal-trigger btn-floating red" href="#modal<?= $i ?>">
                <i class="material-icons">delete</i>
              </a>

              <!-- Modal Structure -->
              <div id="modal<?= $i ?>" class="modal">
                <div class="modal-content">
                  <h4> Suppresion d'un chapitre</h4>
                  <p>
                    Êtes vous sûr de vouloir supprimer le chapitre suivant :
                  </p>
                  <p>
                    <em><?= $chapter->getTitle() ?> publié le <?= $chapter->getCreationDate()->format('d/m/Y') ?></em>
                  </p>
                </div>
                <div class="modal-footer">
                  <a class="modal-close btn-flat">Annuler</a>
                  <a href="index.php?action=deleteChapter&amp;id=<?= $chapter->getId() ?>" class="modal-close btn-flat">Confirmer</a>
                </div>
              </div>
            </td>
          </tr>
          <?php $i++ ?>
        <?php endforeach ?>
      </tbody>
    </table>

    <h4>Commentaires</h4>
    <p>
      Nombre de commentaires signalés par vos lecteurs : <?= $nbReportCom ?>
    </p>

    <table class="hilight responsive-table">
      <thead>
        <tr>
          <th class="test">Commentaire</th>
          <th>Posté le</th>
          <th>A propos du</th>
          <th>Auteur</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($comments as $comment): ?>
          <tr <?php if($comment->getReportCom() == 1 ):?>class="report" <?php endif ?>>
            <td class="commentTable"><?= $comment->getComment() ?></td>
            <td><?= $comment->getCommentDate()->format('d/m/Y') ?></td>
            <td class="titleCommentTable"><?= $comment->getTitle() ?></td>
            <td><?= $comment->getAuthor() ?></td>
            <td>
              <a href="index.php?action=approveComment&amp;id=<?= $comment->getId() ?>" class="btn-floating teal lighten-1">
                <i class="material-icons">check</i>
              </a>
            </td>
            <td>
              <a href="index.php?action=deleteComment&amp;id=<?= $comment->getId() ?>" class="btn-floating red">
                <i class="material-icons">delete</i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

    <div class="returnHome">
      <div class="row center">
        <div class="col s12 ">
          <a href="index.php?action=listChapters" class="btn-floating teal lighten-1 pulse"><i class="material-icons">home</i></a>
        </div>
      </div>
    </div>

  </div>
</div>

               
