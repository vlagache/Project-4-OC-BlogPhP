<div id="authContent">
  <div class="container">
      <form  action= "index.php?action=checkPassword" method="post">
        <div class="row">
          <div class="col s12 m4 offset-m4">
            <div class="input-field">
                <input type="text" id="login" name="login"  />
                <label for="login">Votre identifiant</label><br />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m4 offset-m4">
            <div class="input-field">
                <input type="password" id="password" name="password"  />
                <label for="password">Votre mot de passe</label><br />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m4 offset-m4">
            <button class="btn-small waves-effect waves-light" type="submit" name="action">Valider
              <i class="material-icons right">check</i>
            </button>
          </div>
        </div>
      </form>
  </div>
</div>

<div class="returnHome">
  <div class="row center">
    <div class="col s12 ">
      <a href="index.php?action=listChapters" class="btn-floating teal lighten-1 pulse"><i class="material-icons">home</i></a>
    </div>
  </div>
</div>
