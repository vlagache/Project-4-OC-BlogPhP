<div class="container">
  <div id="titleMain">
      <h1>Un billet simple pour l'Alaska</h1>
  </div>
  <p>
    La publication sur son blog du nouveau roman de Jean Forteroche
  </p>
</div>

<div id="chapters" class="container row">
  <?php foreach($chapters as $chapter):?>
    <?php if($chapter -> getTrashChapter() == 0 ) :?>
        <div class=" col s12 m6 l6 xl4">
          <div class="card z-depth-2">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="<?= ASSETS;?>images/thumbnails/<?= $chapter->getNameThumbnail() ?>">
            </div>
            <div class="card-content">
              <span class="card-title activator blue-grey-text text-darken-3">
                  <?= $chapter->getTitle() ?></br>
                  <em> publié le <?= $chapter->getCreationDate()->format('d/m/Y') ?></em>
                  <i class="material-icons right">more_vert</i>
              </span>
              <p>
                <a href="<?= HOST?>chapter/id/<?= $chapter->getId() ?>">
                  <span class="teal-text text-lighten-1">
                    LIRE LE CHAPITRE
                  </span>
                </a>
              </p>
            </div>
            <div class="card-reveal">
              <span class="card-title blue-grey-text text-darken-3">
                <?= $chapter->getTitle() ?></br>
                <em> publié le <?= $chapter->getCreationDate()->format('d/m/Y') ?></em>
                <i class="material-icons right">close</i>
              </span>
              <p>
                <?= $chapter->getResumeContent() ?>
              </p>
            </div>
          </div>
        </div>
    <?php endif?>
  <?php endforeach ?>
  </div>
</div>

<div id="sliderCom">
  <i class="material-icons quote-left">
    format_quote
  </i>
  <div id="sliderAuthor">
  </div>
  <div id="sliderDate">
  </div>
  <div id="sliderComment">
  </div>
  <i class="material-icons quote-right">
    format_quote
  </i>
</div>
