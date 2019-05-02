class Slider
{
  constructor(array)
  {
    this.array = array;
    this.indice = 0;

    var intervalSlider;
  }
  contentSlider()
  {
    document.getElementById("sliderAuthor").innerHTML = this.array[this.indice].author;
    document.getElementById("sliderComment").innerHTML = this.array[this.indice].comment;
  }
  nextSlide(){
  this.indice++;
   if (this.indice > this.array.length - 1) {
     this.indice = 0 ;
   };
   this.contentSlider();
  }
  autoSlider(){
    this.intervalSlider = setInterval(this.nextSlide.bind(this), 7000);
  }
}
