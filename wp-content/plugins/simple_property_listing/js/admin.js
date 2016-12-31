(function($){

  $(document).ready(function() {
      function close_accordion_section() {
          $('.wprs__accordion .wprs__accordion__title').removeClass('active');
          $('.wprs__accordion .wprs__accordion__section__content').slideUp(300).removeClass('open');
      }

      $('.wprs__accordion__title').click(function(e) {
          // Grab current anchor value
          var currentAttrValue = $(this).attr('href');
          console.log(currentAttrValue);

          if($(e.target).is('.active')) {
              close_accordion_section();
          }else {
              close_accordion_section();

              // Add active class to section title
              $(this).addClass('active');
              // Open up the hidden content panel
              $('.wprs__accordion ' + currentAttrValue).slideDown(300).addClass('open');
          }

          e.preventDefault();
      });
  });





})( jQuery );
