<div id="newChapter">
    <div id="welcomeNew">
        <p>
          Création d'un nouveau chapitre
        </p>
    </div>
    <form action="index.php?action=sendNewChapter" method="post">

         <label for="titleChapter"> Titre du chapitre : </label><br/>
         <input type="text" id="titleChapter" name="titleChapter" value="Titre" />

        <textarea id="tinyMce" name="tinyMceContent" ></textarea>
        <input type="submit" id="submit" value="Publier"  />
    </form>


</div>


<div class="returnHome">
  <a href="index.php?action=adminAuth"> Retour à la page d'administration </a>
</div>
