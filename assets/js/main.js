/* **************** MATERIALIZE JS **************** */
  M.AutoInit();

/* Floating Button */

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.fixed-action-btn');
  var instances = M.FloatingActionButton.init(elems, {
    direction: 'left',
    hoverEnabled: false
  });
});

/* **************** Requete AJAX  **************** */


ajaxGet("api.php", function (reponse){
 var datas = JSON.parse(reponse);
 console.log(datas);
 sliderObj  = new Slider(datas);
 sliderObj.contentSlider();
 sliderObj.autoSlider();
});
