<?php $title = 'Une erreur est survenue'; ?>

<?php ob_start(); ?>
<div id="contentError">
  <div id="errorMsg">
    Erreur : <?= $errorMessage ?>
  </div>
  <div class="returnHome">
    <a href="index.php?action=listChapters"> Retour à la page principale </a>
  </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
