<!--
Affichage
while ($articles = $variable envoyé par le modele ->fetch())

-->
<?php $title = 'Billet simple pour l\'Alaska par Jean Forteroche';?>

<?php ob_start(); ?>
<div id="image_title">
  <img src="public/images/road-alaska2.jpg" alt="Photo d'une route en Alaska" id="imgHome" />
  <h1> Billet simple pour l'Alaska</h1>
  <div id="introduction"> La publication épisodique du nouveau livre de Jean Forteroche </span>
</div>

<div id="chapters">
  <?php
  while ($data = $chapters->fetch())
  {
  ?>
      <div class="chapter">
        <h2>
          <?= $data['title'] ?>
          <em> publié le <?= $data['creation_date_fr'] ?></em>
        </h2>

        <p>
          <?= nl2br($data['resume_content']) ?>
          <br/>
          <span class="chapter_link"><a href="index.php?action=chapter&amp;id=<?= $data['id']?>"> Lire le chapitre </a></span>
        </p>
      </div>
  <?php
  }
  $chapters->closeCursor();
  ?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');?>
