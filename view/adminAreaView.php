 <!-- $i index for create severals modals  -->
<?php $i = 1 ?>

<div id="adminArea">
  <div class="container">

    <h3>Zone d'administration - <?= $_SESSION['admin'] ?></h3>


    <a href="<?= HOST ?>newChapter" class="waves-effect waves-light btn-small"><i class="material-icons right">edit</i>Ecrire un nouveau chapitre</a>

    <div class="title">
      <div class="center">
        <h4>Administration des chapitres</h4>
      </div>
    </div>

    <div id="options">
      <h5> Options </h5>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating teal lighten-1">
            <i class="material-icons">edit</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Modification d'un chapitre existant
        </div>
      </div>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating teal lighten-1">
            <i class="material-icons">restore_from_trash</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Le chapitre est de nouveau visible par vos lecteurs
        </div>
      </div>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating red">
            <i class="material-icons">delete</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Le chapitre est envoyé à la corbeille . Il n'est plus visible par vos lecteurs
        </div>
      </div>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating red">
            <i class="material-icons">delete_forever</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Le chapitre est définitivement supprimé
        </div>
      </div>
    </div>

    <h5> Chapitres </h5>

    <table class="hilight responsive-table">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Publié le</th>
          <th>Dernière modification</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($chapters as $chapter): ?>
          <?php if($chapter -> getTrashChapter() == 0 ) :?>
            <tr>
              <td><?= $chapter->getTitle() ?></td>
              <td><?= $chapter->getCreationDate()->format('d/m/Y à H:i') ?></td>
              <td>
                <?php if($chapter->getEditDate() == null ):?>
                  <p>
                    Jamais modifié
                  </p>
                <?php else : ?>
                  <?= $chapter->getEditDate()->format('d/m/Y à H:i') ?>
                <?php endif ?>
              </td>
              <td>
                <a href="<?= HOST ?>editChapter/id/<?= $chapter->getId()?>" class="btn-floating teal lighten-1">
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
                    <h4> Envoi d'un chapitre à la corbeille </h4>
                    <p>
                      Êtes vous sûr d'envoyer le chapitre suivant à la corbeille :
                    </p>
                    <p>
                      <em><?= $chapter->getTitle() ?> publié le <?= $chapter->getCreationDate()->format('d/m/Y') ?></em>
                    </p>
                    <p>
                      Il ne sera plus visible par vos lecteurs
                    </p>
                  </div>
                  <div class="modal-footer">
                    <a class="modal-close btn-flat">Annuler</a>
                    <a href="<?= HOST ?>trashChapter/id/<?= $chapter->getId()?>" class="modal-close btn-flat">Confirmer</a>
                  </div>
                </div>
              </td>
            </tr>
          <?php endif?>
          <?php $i++ ?>
        <?php endforeach ?>

      </tbody>
    </table>

    <div id="chapMod">
      <h5> Corbeille </h5>
      <table class="hilight responsive-table">
        <thead>
          <th>Titre</th>
          <th>Publié le</th>
          <th>Dernière modification</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </thead>

        <tbody>
          <?php foreach($chapters as $chapter) :?>
            <?php if($chapter->getTrashChapter() == 1 ) :?>
              <tr>
                <td><?= $chapter->getTitle() ?></td>
                <td><?= $chapter->getCreationDate()->format('d/m/Y à H:i') ?></td>
                <td>
                  <?php if($chapter->getEditDate() == null ):?>
                    <p>
                      Jamais modifié
                    </p>
                  <?php else : ?>
                    <?= $chapter->getEditDate()->format('d/m/Y à H:i') ?>
                  <?php endif ?>
                </td>
                <td>

                  <a href="<?= HOST ?>restoreChapter/id/<?= $chapter->getId() ?>" class="btn-floating teal lighten-1">
                    <i class="material-icons">restore_from_trash</i>
                  </a>
                </td>
                <td>
                  <!-- Modal Trigger -->
                  <a class="modal-trigger btn-floating red" href="#modal<?= $i ?>">
                    <i class="material-icons">delete_forever</i>
                  </a>

                  <!-- Modal Structure -->
                  <div id="modal<?= $i ?>" class="modal">
                    <div class="modal-content">
                      <h4> Suppresion d'un chapitre</h4>
                      <p>
                        Êtes vous sûr de vouloir supprimer definitivement le chapitre suivant :
                      </p>
                      <p>
                        <em><?= $chapter->getTitle() ?> publié le <?= $chapter->getCreationDate()->format('d/m/Y') ?></em>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <a class="modal-close btn-flat">Annuler</a>
                      <a href="<?= HOST ?>deleteChapter/id/<?= $chapter->getId() ?>" class="modal-close btn-flat">Confirmer</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php $i++ ?>
            <?php endif ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>


    <div class="row line">
      <div class="col s12">
      </div>
    </div>

    <div class="title">
      <div class="center">
        <h4>Administration des commentaires</h4>
      </div>
    </div>


    <div class="row">
      <div class="col s1">
        <div class="<?php if($nbReportCom !=0 ):?> redButton <?php endif ?> btn-report-com">
          <span>
            <?= $nbReportCom ?>
          </span>
        </div>
      </div>
      <div class="col s10 offset-s1 m11">
        Nombres de commentaires signalés par vos lecteurs
      </div>
    </div>

    <div id="options">
      <h5> Options </h5>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating teal lighten-1">
            <i class="material-icons">check</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Le commentaire n'est plus marqué comme "signalé" dans la zone d'administration
        </div>
      </div>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating teal lighten-1">
            <i class="material-icons">restore_from_trash</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Le commentaire est de nouveau visible pour vos lecteurs
        </div>
      </div>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating red">
            <i class="material-icons">gavel</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Le commentaire n'est plus visible pour vos lecteurs mais n'est pas définitivement supprimé
        </div>
      </div>
      <div class="row">
        <div class="col s1">
          <a class="btn-floating red">
            <i class="material-icons">delete_forever</i>
          </a>
        </div>
        <div class="col s10 offset-s1 m11">
          Le commentaire est définitivement supprimé
        </div>
      </div>
    </div>



    <h5> Commentaires </h5>


    <table class="hilight responsive-table">
      <thead>
        <tr>
          <th>Commentaire</th>
          <th>Posté le</th>
          <th>A propos du</th>
          <th>Auteur</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($comments as $comment): ?>
            <?php if($comment->getHiddenCom() == 0) :?>
              <tr <?php if($comment->getReportCom() == 1 ):?>class="report" <?php endif ?>>
                <td><?= $comment->getResumeComment() ?></td>
                <td><?= $comment->getCommentDate()->format('d/m/Y') ?></td>
                <td><?= $comment->getTitle() ?></td>
                <td><?= $comment->getAuthor() ?></td>
                <td>

                  <a href="<?= HOST ?>approveComment/id/<?= $comment->getId()?>" class="btn-floating teal lighten-1">
                    <i class="material-icons">check</i>
                  </a>
                </td>
                <td>
                  <!-- Modal Trigger -->
                  <a class="modal-trigger btn-floating red" href="#modal<?= $i ?>">
                    <i class="material-icons">gavel</i>
                  </a>

                  <!-- Modal Structure -->
                  <div id="modal<?= $i ?>" class="modal">
                    <div class="modal-content">
                      <h4> Modération d'un commentaire</h4>
                      <p>
                        Êtes vous sûr de vouloir modérer le commentaire suivant :
                      </p>
                      <p>
                        <em>" <?= $comment->getComment(); ?> " </em> publié le <?= $comment->getCommentDate()->format('d/m/Y') ?> par <?= $comment->getAuthor() ?>
                      </p>
                      <p>
                        Vos lecteurs verront le message suivant : *** Message supprimé par l'administrateur ***
                      </p>
                    </div>
                    <div class="modal-footer">
                      <a class="modal-close btn-flat">Annuler</a>
                      <a href="<?= HOST ?>hiddenComment/id/<?= $comment->getId() ?>" class="modal-close btn-flat">Confirmer</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endif ?>
          <?php $i++ ?>
        <?php endforeach ?>
      </tbody>
    </table>


    <div id="comMod">

      <h5> Commentaires modérés </h5>



      <table class="hilight responsive-table">
        <thead>
          <tr>
            <th>Commentaire</th>
            <th>Posté le</th>
            <th>Auteur</th>
            <th>Modéré par</th>
            <th>Modéré le</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($comments as $comment):?>
            <?php if($comment->getHiddenCom() == 1):?>
              <tr>
                <td><?= $comment->getResumeComment() ?></td>
                <td><?= $comment->getCommentDate()->format('d/m/Y') ?></td>
                <td><?= $comment->getAuthor() ?></td>
                <td><?= $comment->getHiddenBy() ?></td>
                <td><?= $comment->getHiddenDate()->format('d/m/Y à H:i') ?></td>
                <td>
                  <a href="<?= HOST ?>restoreComment/id/<?= $comment->getId() ?>" class="btn-floating teal lighten-1">
                    <i class="material-icons">restore_from_trash</i>
                  </a>

                </td>
                <td>
                  <!-- Modal Trigger -->
                  <a class="modal-trigger btn-floating red" href="#modal<?= $i ?>">
                    <i class="material-icons">delete_forever</i>
                  </a>

                  <!-- Modal Structure -->
                  <div id="modal<?= $i ?>" class="modal">
                    <div class="modal-content">
                      <h4> Suppression definite d'un commentaire </h4>
                      <p>
                        Êtes vous sûr de vouloir de supprimer définitivement le commentaire suivant :
                      </p>
                      <p>
                        <em>" <?= $comment->getComment(); ?> " </em> publié le <?= $comment->getCommentDate()->format('d/m/Y') ?> par <?= $comment->getAuthor() ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <a class="modal-close btn-flat">Annuler</a>
                      <a href="<?= HOST ?>deleteComment/id/<?= $comment->getId() ?>" class="modal-close btn-flat">Confirmer</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endif ?>
            <?php $i++ ?>
          <?php endforeach ?>
        </tbody>

      </table>
    </div>



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
