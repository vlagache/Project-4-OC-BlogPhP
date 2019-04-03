<?php $title = $chapter['title']?>

<?php ob_start(); ?>
<div id="contentChapter">
  <h2 id="chapterViewTitle"><?= htmlspecialchars($chapter['title']) ?></h2>
  <p>
    <?= nl2br(htmlspecialchars($chapter['content'])) ?>
  </p>
  <div id="nextChapter">
    <a href="index.php?action=chapter&amp;id=<?=$chapter['id'] + 1?>"> Chapitre suivant</a>
  </div>
  <div id="previousChapter">
    <a href="index.php?action=chapter&amp;id=<?=$chapter['id'] - 1?>"> Chapitre précédent</a>
  </div>
</div>

<h2 id="commentTitle">Commentaires</h2>
<div id="contentComment">
  Liste des commentaires
</div>

<h2 id="postCommentTitle">Ecrire un commentaire</h2>
  <form action="listChapters" method="post">
    <!-- index.php?action=addComment&amp;id=<?= $post['id'] ?> -->
      <div>
          <label for="author">Auteur</label><br />
          <input type="text" id="author" name="author" value="   Votre nom " />
      </div>
      <div>
          <label for="comment">Commentaire</label><br />
          <textarea id="comment" name="comment" > Ecrire votre commentaire ici ! </textarea>
      </div>
      <div>
          <input type="submit" id="submit" />
      </div>
  </form>

<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>
<?php $content = ob_get_clean(); ?>
<?php require(VIEW.'template.php');?>
