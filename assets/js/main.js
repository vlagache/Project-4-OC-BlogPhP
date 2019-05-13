/* **************** Requete AJAX  **************** */


ajaxGet(API_URL+"displayComment", function (reponse){
 var datas = JSON.parse(reponse);
 sliderObj  = new Slider(datas);
 sliderObj.contentSlider();
 sliderObj.autoSlider();
});
