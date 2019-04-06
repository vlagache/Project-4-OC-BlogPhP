<!--
Affichage
while ($articles = $variable envoyé par le modele ->fetch())

-->
<?php $title = 'Billet simple pour l\'Alaska par Jean Forteroche';?>

<?php ob_start(); ?>
<div id="blockHome">
  <div id="chapters">
    <?php while ($data = $chapters->fetch()): ;?>
        <?php $titles[] = htmlspecialchars($data['title']);  ?>
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
  <div id="infos">
    <div id="lastChapters">
      <h2> Chapitres </h2>
      <div class="tableOfContent">
        <ul>
          <?php foreach ($titles as $title):?>
              <li><?= $title;?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div id="lastComments">
      <h2> Commentaires </h2>
    </div>
  </div>
</div>


<?php $content = ob_get_clean(); ?>
<?php require(VIEW.'template.php');?>
