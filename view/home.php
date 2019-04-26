<div class="container">
  <div id="title">
      <h1>Un billet simple pour l'Alaska</h1>
  </div>
  <p>
    La publication sur son blog du nouveau roman de Jean Forteroche
  </p>
</div>

<div id="chapters" class="container row">
  <?php foreach($chapters as $chapter):?>
      <?php $titles[$chapter->getId()] = ($chapter->getTitle());  ?>
      <div class=" col s12 m6 l6 xl4">
        <div class="card z-depth-2">
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="<?= ASSETS;?>images/book.jpg">
          </div>
          <div class="card-content">
            <span class="card-title activator blue-grey-text text-darken-3">
                <?= $chapter->getTitle() ?></br>
                <em> publié le <?= $chapter->getCreationDate()->format('d/m/Y') ?></em>
                <i class="material-icons right">more_vert</i>
            </span>
            <p>
              <a href="index.php?action=chapter&amp;id=<?= $chapter->getId() ?>">
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
  <?php endforeach ?>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class=" col s12 m8">
      <div class="card test">
        <div class="card-image waves-effect waves-block waves-light">
          <img class="activator" src="<?= ASSETS;?>images/pen.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4">Derniers commentaires publiés<i class="material-icons right">more_vert</i></span>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4">Derniers commentaires publiés<i class="material-icons right">close</i></span>
          <p>
            <?php foreach ($comments as $key => $comment): ?>
              <?php if ($key<=5): ?>
                  <p>
                      <strong><?= $comment->getAuthor() ?></strong>
                      le <?= $comment->getCommentDate()->format('d/m/Y') ?> à propos du <a href="index.php?action=chapter&amp;id=<?= $comment->getChapterId()?>"><?= $comment->getTitle() ?> </a>
                  </p>
                  <p class="comment">
                      <?= $comment->getComment() ?>
                  </p>
              <?php endif ?>
            <?php endforeach ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
