


(function($){



  function close_accordion_section() {
      $('.wprs__accordion .wprs__accordion__section__title').removeClass('active');
      $('.wprs__accordion .wprs__accordion__section__content').slideUp(300).removeClass('open');
  }


// the toggle of the accordion
  function toggle(){
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

  }

// this does the on ready of the of the function

  $(document).on('ready', function(e, widget) {
    var widget_id = $(widget).attr('id');
    close_accordion_section();
    toggle();

  });


// this runs my code if the widget is saved. If a different widget is saved then it doesn't fire my code.
  $(document).on('widget-added widget-updated', function(e, widget){

    var widget_id = $(widget).attr('id');

    console.log(widget_id);
    if($(widget).attr('id').includes('simpley_realestate_widget')){
      close_accordion_section();
      toggle();

      console.log('realestate widget saved');
    }else{
      console.log('a different widget is saved or added');
    }

  });









})( jQuery );
