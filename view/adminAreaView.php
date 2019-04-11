<?php $title = 'Zone Administration' ?>

<?php ob_start(); ?>

<div id="adminArea">
 <p>
   Bienvenue dans la zone d'administration</br>
   <?= $_SESSION['user'] ?>
 </p>
 <form action="index.php?action=logout" method="post" id="logoutForm">
   <div>
     <input type="submit" id="submit" value="Déconnexion"  />
   </div>
 </form>
</div>

<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>

<?php $content = ob_get_clean(); ?>
<?php require(VIEW.'template.php');?>
