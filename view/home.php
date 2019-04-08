<!--
Affichage
while ($articles = $variable envoyé par le modele ->fetch())

-->
<?php $title = 'Billet simple pour l\'Alaska par Jean Forteroche';?>

<?php ob_start(); ?>

<div id="chapters">
  <?php while ($data = $chapters->fetch()): ;?>
      <?php $titles[$data['id']] = htmlspecialchars($data['title']);  ?>
      <div class="chapter">
          <h2>
            <?= htmlspecialchars($data['title']) ?>
            <em> publié le <?= $data['creation_date_fr'] ?></em>
          </h2>
          <p>
            <?= nl2br(htmlspecialchars($data['resume_content'])) ?>
            <br/>
            <span class="chapter_link"><a href="index.php?action=chapter&amp;id=<?= $data['id']?>"> Lire le chapitre </a></span>
          </p>
      </div>
<?php endwhile ?>
</div>
<div id="lastChapters">
  <h2> Derniers chapitres publiés </h2>
  <div id="tableOfContent">
    <ul>
      <?php foreach ($titles as $id => $title):?>
          <li><a href="index.php?action=chapter&amp;id=<?= $id?>"><?= $title ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<div id="lastComments">
  <h2> Derniers commentaires publiés </h2>
  <div id="listOfLastComments">
    <?php while($lastComments = $comments->fetch()): ;?>
      <div class="commentHome">
        <p>
          <strong><?= htmlspecialchars($lastComments['author']) ?></strong>
          le <?= $lastComments['comment_date_fr'] ?> à propos du <a href="index.php?action=chapter&amp;id=<?= $lastComments['chapter_id']?>"><?= $lastComments['title'] ?></a>
        </p>
        <p>
          <?= nl2br(htmlspecialchars($lastComments['comment'])) ?>
        </p>
      </div>
    <?php endwhile ?>
  </div>
</div>




<?php $content = ob_get_clean(); ?>
<?php require(VIEW.'template.php');?>
