<div id="contentChapter">
  <h2 id="chapterViewTitle">
    <?= $chapter->getTitle() ?>
  </h2>
  <p>
    <?= nl2br($chapter->getContent()) ?>
  </p>
  <div id="nextChapter">
    <a href="index.php?action=chapter&amp;id=<?=$chapter->getNextId()?>"> Chapitre suivant</a>
  </div>
  <div id="previousChapter">
    <a href="index.php?action=chapter&amp;id=<?=$chapter->getPreviousId()?>"> Chapitre précédent</a>
  </div>
</div>


<h2 id="commentTitle">Commentaires</h2>
<div id="contentComment">
  <div id="contentBlock">
    <?php foreach ($comments as $comment): ?>
      <div class="commentChapter">
           <p class="authorComment">
               <strong><?= $comment->getAuthor() ?></strong>
               le <?= $comment->getCommentDate()->format('d/m/Y à H:i') ?>
           </p>
           <p class="commentComment">
               <?= $comment->getComment() ?>
           </p>
           <div class="reportCom">
               <i class="fas fa-exclamation"></i>
               <p>
                 <a href="index.php?action=reportComment&amp;idCom=<?= $comment->getId()?>&amp;id=<?= $comment->getChapterId()?>">Signaler le commentaire </a>
               </p>
           </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<h2 id="postCommentTitle">Ecrire un commentaire</h2>
<form action="index.php?action=addComment&amp;id=<?= $chapter->getId() ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="   Votre nom " />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment" > Ecrire votre commentaire ici ! </textarea>
    </div>
    <div>
        <input type="submit" id="submit"  />
    </div>
</form>

<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>
