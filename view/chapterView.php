<?php $title = $chapter['title']?>

<?php ob_start(); ?>
<h2 id="chapterViewTitle"><?= htmlspecialchars($chapter['title']) ?></h2>

<div id="contentChapter">
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

<h2>Commentaires</h2>
  <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
      <div>
          <label for="author">Auteur</label><br />
          <input type="text" id="author" name="author" />
      </div>
      <div>
          <label for="comment">Commentaire</label><br />
          <textarea id="comment" name="comment"></textarea>
      </div>
      <div>
          <input type="submit" />
      </div>
  </form>      
<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>
<?php $content = ob_get_clean(); ?>
<?php require(VIEW.'template.php');?>
