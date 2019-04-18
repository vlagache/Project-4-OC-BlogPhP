

<div id="adminArea">
   <p>
       Bienvenue dans la zone d'administration</br>
       <?= $_SESSION['admin'] ?>
   </p>
   <form  action="index.php?action=adminArea" method="post">
      <textarea id="tinyMce" name="tinyMceContent">Hello, World!</textarea>
      <div>
          <input type="submit" id="submit"  />
      </div>
  </form>
</div>

<div>
<?php if(isset($_POST['tinyMceContent'])): echo $_POST['tinyMceContent']; endif ?>
</div>

<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>
