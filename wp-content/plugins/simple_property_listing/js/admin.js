(function($){



  $(document).on('ready', function(e) {

      function close_accordion_section() {
          $('.wprs__accordion .wprs__accordion__section__title').removeClass('active');
          $('.wprs__accordion .wprs__accordion__section__content').slideUp(300).removeClass('open');
      }

      $('.wprs__accordion__section__title').on('click',function(e) {
          // Grab current anchor value
          var currentAttrValue = $(this).attr('href');
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

      $('.wprs__accordion__section__title').click(function(){
      $('.wprs__arrow').toggleClass('wprs__arrow__up');
      });
      console.log(e);

  });







})( jQuery );
