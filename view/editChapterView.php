<div id="editChapter">
    <div id="welcomeEdit">
        <p>
          Edition du <?= $chapter->getTitle() ?>
        </p>
    </div>
    <form action="index.php?action=sendEditChapter&amp;id=<?=$chapter->getId() ?>" method="post">

         <label for="titleChapter"> Changer le titre du chapitre : </label><br/>
         <input type="text" id="titleChapter" name="titleChapter" value="<?=$chapter->getTitle() ?>" />

        <textarea id="tinyMce" name="tinyMceContent" ><?=$chapter->getContent()?></textarea>
        <input type="submit" id="submit" value="Modifier"  />
    </form>


</div>


<div class="returnHome">
  <a href="index.php?action=adminAuth"> Retour à la page d'administration </a>
</div>
