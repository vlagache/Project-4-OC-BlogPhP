<?php $title = 'Zone Administration' ?>

<?php ob_start(); ?>

<div id="adminArea">
 <p>
   <?= $test ?>
 </p>
</div>

<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>

<?php $content = ob_get_clean(); ?>
<?php require(VIEW.'template.php');?>
