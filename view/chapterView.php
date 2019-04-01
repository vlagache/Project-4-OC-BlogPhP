<?php $title = $chapter['title']?>

<?php ob_start(); ?>
<h2 id="chapterViewTitle"><?= $chapter['title'] ?></h2>

<div id="contentChapter">
  <p>
    <?= nl2br($chapter['content']) ?>
  </p>
  <div id="nextChapter">
    <a href="index.php?action=chapter&amp;id=<?=$chapter['id'] + 1?>"> Chapitre suivant</a>
  </div>
  <div id="previousChapter">
    <a href="index.php?action=chapter&amp;id=<?=$chapter['id'] - 1?>"> Chapitre précédent</a>
  </div>
</div>
<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');?>
