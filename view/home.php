<div id="chapters">
  <?php foreach($chapters as $chapter):?>
      <?php $titles[$chapter->getId()] = ($chapter->getTitle());  ?>
      <div class="chapter">
          <h2>
            <?= $chapter->getTitle() ?>
            <em> publié le <?= $chapter->getCreationDate()->format('d/m/Y') ?></em>
          </h2>
          <p>
            <?= $chapter->getResumeContent() ?>
            <br/>
            <span class="chapter_link"><a href="index.php?action=chapter&amp;id=<?= $chapter->getId() ?>"> Lire le chapitre </a></span>
          </p>
      </div>
<?php endforeach ?>
</div>
<div id="lastChapters">
  <h2> Derniers chapitres publiés </h2>
  <div id="tableOfContent">
    <ul>
      <?php foreach ($titles as $id => $title):?>
          <li><a href="index.php?action=chapter&amp;id=<?= $id?>"><?= $title ?></a></li>
      <?php endforeach ?>
    </ul>
  </div>
</div>
<div id="lastComments">
  <h2> Derniers commentaires publiés </h2>
  <div id="listOfLastComments">
    <?php foreach ($comments as $comment): ?>
      <div class="commentHome">
        <p>
          <strong><?= $comment->getAuthor() ?></strong>
          le <?= $comment->getCommentDate()->format('d/m/Y') ?> à propos du <a href="index.php?action=chapter&amp;id=<?= $comment->getChapterId()?>"><?= $comment->getTitle() ?></a>
        </p>
        <p>
          <?= $comment->getComment() ?>
        </p>
      </div>
    <?php endforeach ?>
  </div>
</div>
