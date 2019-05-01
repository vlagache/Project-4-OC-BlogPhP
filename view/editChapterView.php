<div class="container">

  <div class="row">
    <div class="col s12">
      <h4>Edition du chapitre  : <em><?= $chapter->getTitle() ?></em></h2>
    </div>
  </div>

  <form action="index.php?action=sendEditChapter&amp;id=<?=$chapter->getId() ?>" method="post">

    <div class="row">
      <div class="col s12 m10">
        <div class="input-field">
          <input id="titleChapter" name="titleChapter" type="text" value="<?= $chapter->getTitle() ?>">
          <label for="titleChapter">Changer le titre du chapitre</label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m10">
        <textarea id="tinyMce" name="tinyMceContent" ><?=$chapter->getContent()?></textarea>
      </div>
    </div>


    <div class="row">
      <div class="col s12 m8">
        <button class="btn-small waves-effect waves-light" type="submit" name="action">Modifier le chapitre
          <i class="material-icons right">check</i>
        </button>
      </div>
    </div>

  </form>

  <div class="returnHome">
    <div class="row center">
      <div class="col s12 ">
        <a href="index.php?action=adminAuth" class="btn-floating teal lighten-1 pulse"><i class="material-icons">home</i></a>
      </div>
    </div>
  </div>

</div>
