<div class="container">
  <div class="row">
    <div class="col s12 m10">
      <h2>
        <?= $chapter->getTitle() ?>
      </h2>
      <h5>
        Publié le <?= $chapter->getCreationDate()->format('d/m/Y'); ?>
      </h5>
      <?php if($chapter->getEditDate() != null) :?>
       <em>
         Derniere modification le : <?= $chapter->getEditDate()->format('d/m/Y à H:i') ?>
       </em>
      <?php endif ?>
      <div class="contentChapter">
        <p>
          <?= nl2br($chapter->getContent()) ?>
        </p>
      </div>
    </div>
  </div>



  <div class="row">

    <div class="col s1 m1 ">

      <a href="index.php?action=chapter&amp;id=<?=$chapter->getPreviousId()?>" class="btn-floating teal lighten-1
        <?php if ($chapter->getPreviousId() == null):?> disabled <?php else: ?> pulse <?php endif?>">
        <i class="material-icons">navigate_before</i>
      </a>

    </div>

    <div id="nextChapterButton">
      <div class="col s1 offset-s9 m1 offset-m8 ">

        <a href="index.php?action=chapter&amp;id=<?=$chapter->getNextId()?>" class="btn-floating teal lighten-1
          <?php if ($chapter->getNextId() == null):?> disabled <?php else: ?> pulse <?php endif?>">
          <i class="material-icons">navigate_next</i>
        </a>

      </div>
    </div>
  </div>






  <h3 id="commentTitle">Commentaires</h3>
  <div id="contentComment">
    <div class="row">
      <div class="col s12 m8">
        <?php if(empty($comments)):?>
          <p>
            Aucun commentaire n'a été fait à propos de ce chapitre , soyez le premier !
          </p>
        <?php endif ?>
        <!-- $i Create severals modals & not always display the same !-->
        <?php $i = 1 ?>
          <?php foreach ($comments as $comment): ?>
            <div>
                 <p>
                     <strong><?= $comment->getAuthor() ?></strong>
                     le <?= $comment->getCommentDate()->format('d/m/Y à H:i') ?>
                 </p>
                 <p>
                   <?php if($comment->getHiddenCom() == 1):?>
                     <p>*** Message supprimé par l'administrateur *** </p>
                   <?php else : ?>
                     <em><?= $comment->getComment() ?></em>
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
                   <?php endif ?>
                 </p>
            </div>
            <?php $i++ ?>
          <?php endforeach ?>
      </div>
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
      <div class="row">
        <div class="col s12">
          <button class="btn-small waves-effect waves-light" type="submit" name="action">Poster le commentaire
            <i class="material-icons right">check</i>
          </button>
        </div>
      </div>
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
