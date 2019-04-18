<div id="adminArea">

  <div id="welcomeAdmin">
    <p>
      Zone d'administration - connecté en tant que <?= $_SESSION['admin'] ?>
    </p>
  </div>

  <div id="newChapter">
    Boutton nouveau Chapitre
  </div>

  <div id="chaptersAdmin">
    <?php foreach($chapters as $chapter): ?>
      <?= $chapter->getTitle() ?>
      - publié le       <?= $chapter->getCreationDate()->format('d/m/Y') ?>
      - Modifier
      - Supprimer
    </br>
    <?php endforeach ?>
  </div>

  <div id="commentsAdmin">
    <?php foreach($comments as $comment): ?>
      <?= $comment->getComment() ?>
      - posté le       <?= $comment->getCommentDate()->format('d/m/Y') ?>
      - a propos du <?= $comment->getTitle() ?>
      - par <?= $comment->getAuthor() ?>
      - Supprimer
    </br>
    <?php endforeach ?>
  </div>

</div>                  
