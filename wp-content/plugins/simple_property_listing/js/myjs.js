(function($){

$(document).ready(function () {

// this button makes the thumbnail images hide and show
    $(".button").click(function(){
    $(".img_size").toggle();
});


//this changes the thumbnail with the hero image once clicked
$('.img_height img').click(function(e){
  e.preventDefault();
  var imgbg = $(this).attr('src');
  console.log(imgbg);
  $('.header-wrap').css({backgroundImage: "url("+imgbg+")"});

});

  // This toggles the squish button
$('.squish').toggle(function(){
    // this changes the background image from cover to contain
   $('.header-wrap').css('background-size','contain');
   // this adds a background color
   $('.header-wrap').css('background-color','#464b50');
    // this makes the background center once it's squish
   $('.header-wrap').css('background-position','50% 0');
    // this moves the header to fit once the image is squished
   $('.entery-title').css('left', '760px');
   // this moves the view photo to fit once the image is squished
   $('.button').css('left', '250px');
   //this moves the squsih button to fit in the image once squished
   $('.squish').css('left', '263px');

   // this changes the button icons
   $('.squish img').attr('src', function(i,e){
     return e.replace('arrowsquishs.svg','arrowstreached.svg');
   })
}, function(){
  //this changes the background back to cover
  $('.header-wrap').css('background-size','cover');
    //this moves the header back once they un squisehd the image
  $('.entery-title').css('left', '900px');
  // tis moves the view photos back
  $('.button').css('left', '70px');
  //this moves the squsih button back.
  $('.squish').css('left', '77px');
  //this returns the button back to the deafult
  $('.squish img').attr('src', function(i,e){
    return e.replace('arrowstreached.svg','arrowsquishs.svg');
  })
});

//checking if my col is empty
function isEmpty( el ){
    return !$.trim(el.html())
}
if (isEmpty($('.empty'))) {
    // do something
    $('.empty').remove();
    $('.img_heigth').removeClass('col-sm-5');
    $('.img_heigth').addClass('col-sm-12');

}

$(function() {
    $('.box').matchHeight();
});

// tell Chosen that a select has changed
$('.my_select_box').trigger('chosen:updated');




});


})( jQuery );
