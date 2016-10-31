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
   $('.header-wrap').css('background-position','50% 0')
   // this changes the button icons
   $('.squish img').attr('src', function(i,e){
     return e.replace('arrowsquishs.svg','arrowstreached.svg');
   })
}, function(){
  //this changes the background back to cover
  $('.header-wrap').css('background-size','cover');
  //this returns the button back to the deafult
  $('.squish img').attr('src', function(i,e){
    return e.replace('arrowstreached.svg','arrowsquishs.svg');
  })
});



});


})( jQuery );
