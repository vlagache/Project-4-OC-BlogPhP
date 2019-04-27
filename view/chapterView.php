<div class="container">
  <div class="row">
    <div class="col s12 m10">
      <h2>
        <?= $chapter->getTitle() ?>
      </h2>
      <h5>
        <?= $chapter->getCreationDate()->format('d/m/Y'); ?>
      </h5>
      <div class="contentChapter">
        <p>
          <?= nl2br($chapter->getContent()) ?>
        </p>
      </div>
    </div>
  </div>



  <div class="row">
    <div class="col s12 m4">
        <a href="index.php?action=chapter&amp;id=<?=$chapter->getPreviousId()?>"> Chapitre précédent</a>
    </div>
    <div class="col s12 m3 offset-m5 ">
        <a href="index.php?action=chapter&amp;id=<?=$chapter->getNextId()?>"> Chapitre suivant</a>
    </div>
  </div>





  <h3 id="commentTitle">Commentaires</h3>
  <div class="row">
    <div class="col s12 m8">
      <!-- $i Create severals modals & not always display the same !-->
      <?php $i = 1 ?>
        <?php foreach ($comments as $comment): ?>
          <div>
               <p>
                   <strong><?= $comment->getAuthor() ?></strong>
                   le <?= $comment->getCommentDate()->format('d/m/Y à H:i') ?>
               </p>
               <p>
                   <?= $comment->getComment() ?>
               </p>
               <div>
                 <p>
                   <!-- Modal Trigger -->
                   <a class="modal-trigger" href="#modal<?= $i ?>">Signaler le commentaire</a>

                   <!-- Modal Structure -->
                   <div id="modal<?= $i ?>" class="modal">
                     <div class="modal-content">
                       <h4> Signalement d'un commentaire </h4>
                       <p>
                           Commentaire : " <em><?= $comment->getComment() ?> </em>"
                       </p>
                       <p>
                         Êtes vous sûr de vouloir signaler ce commentaire à notre modération ?
                       </p>
                     </div>
                     <div class="modal-footer">
                       <a class="modal-close btn-flat">Annuler</a>
                       <a href="index.php?action=reportComment&amp;idCom=<?= $comment->getId()?>&amp;id=<?= $comment->getChapterId()?>" class="modal-close btn-flat">Confirmer</a>
                     </div>
                   </div>
                 </p>
               </div>
          </div>
          <?php $i++ ?>
        <?php endforeach ?>
    </div>
  </div>


  <h3 id="postCommentTitle">Ecrire un commentaire</h3>
  <div id="formComment">
    <form action="index.php?action=addComment&amp;id=<?= $chapter->getId() ?>" method="post">
      <div class="row">
        <div class="col s12 m8">
          <div class="input-field">
              <input id="author" name="author" type="text" >
              <label for="author">Auteur du commentaire</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m8">
          <div class="input-field">
              <textarea id="comment" name="comment" class="materialize-textarea" ></textarea>
              <label for="comment">Ecrire votre commentaire ici ! </label>
          </div>
        </div>
      </div>
      <button class="btn-small waves-effect waves-light" type="submit" name="action">Poster le commentaire
        <i class="material-icons right">check</i>
      </button>
    </form>
  </div>

  <div class="returnHome">
    <div class="row center">
      <div class="col s12 ">
        <a href="index.php?action=listChapters" class="btn-floating teal lighten-1 pulse"><i class="material-icons">home</i></a>
      </div>
    </div>
  </div>





</div>
