<?php

// this changes the exceprt length to 20.
function jk_excerpt_length( $length) {
        return 20;
    }
    add_filter( 'excerpt_length', 'jk_excerpt_length', 999 );

    // this changes the end of the exceprt isntead of saying read more it gives it leader dots
    function jk_excerpt_more( $more ) {
      return ' .....';
  }
  add_filter( 'excerpt_more', 'jk_excerpt_more' );


// this lets me display 9 items on the archive page
function custom_type_archive_display($query) {
    if (is_post_type_archive('realestate_listings')) {
        $query->set('posts_per_page',9);
        return;
    }
}

add_action('pre_get_posts', 'custom_type_archive_display');

// this lets me query over the custom tags taxonomies
function custom_post_type_tags( $tags ) {
    if ( !is_admin() && $tags->is_tag() && $tags->is_main_query() ) {
        $tags->set( 'realestate_listings', [ 'post', 'Features_tags' ] );
    }
}
add_action( 'pre_get_posts', 'custom_post_type_tags' );



?>
