<div class="container">
  <div class="row">
    <div class="col s12">
      <h4>Création d'un nouveau chapitre</h2>
    </div>
  </div>



  <form action="index.php?action=sendNewChapter" method="post" enctype="multipart/form-data">

     <div class="row">
       <div class="col s12 m10">
         <div class="input-field">
           <input id="titleChapter" name="titleChapter" type="text" >
           <label for="titleChapter">Titre du chapitre</label>
         </div>
       </div>
     </div>


     <div class="row">
       <div class="col s12 m10">
         <div class="file-field input-field">
           <div class="btn">
             <span>Fichier</span>
             <input type="file" name="thumbnail" id="thumbnail">
           </div>
           <div class="file-path-wrapper">
             <input class="file-path validate" type="text" placeholder="Chargez une miniature pour le chapitre">
            <span class="helper-text">Pour un affichage optimal de votre miniature , choissisez une photo avec un ratio de 1.5 ( Longueur / Largeur = 1.5 ) </span>
           </div>
         </div>
       </div>
     </div>



     <div class="row">
       <div class="col s12 m10">
         <textarea id="tinyMce" name="tinyMceContent" ></textarea>
       </div>
     </div>

     <div class="row">
       <div class="col s12 m8">
         <button class="btn-small waves-effect waves-light" type="submit" name="action">Publier le chapitre
           <i class="material-icons right">check</i>
         </button>
       </div>
     </div>

  </form>

  <div class="returnHome">
    <div class="row center">
      <div class="col s12 ">
        <a href="<?= HOST ?>adminArea" class="btn-floating teal lighten-1 pulse"><i class="material-icons">home</i></a>
      </div>
    </div>
  </div>

</div>
