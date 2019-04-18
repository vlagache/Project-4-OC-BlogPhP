<div id="formAdmin">
    <form  action= "index.php?action=checkPassword" method="post">
      <div>
          <label for="login">Votre identifiant</label><br />
          <input type="text" id="login" name="login"  />
      </div>
      <div>
          <label for="password">Mot de passe</label><br />
          <input type="password" id="password" name="password"  />
      </div>
      <div>
          <input type="submit" id="submit"  />
      </div>
    </form>
</div>

<div class="returnHome">
  <a href="index.php?action=listChapters"> Retour à la page principale </a>
</div>
