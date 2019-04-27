<?php $title = 'Une erreur est survenue'; ?>

<?php ob_start(); ?>

<div id="error">

  <div id ="errorContent">
    <div class="container">
      <div class="row">
        <div class="col s12 m8">
          <div id="errorMsg">
            <h4>
              Erreur : <?= $errorMessage ?>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="returnHome">
    <div class="row center">
      <div class="col s12 ">
        <a href="index.php?action=listChapters" class="btn-floating teal lighten-1 pulse"><i class="material-icons">home</i></a>
      </div>
    </div>
  </div>

</div>

<?php $content = ob_get_clean(); ?>
<?php require(VIEW.'template.php'); ?>
