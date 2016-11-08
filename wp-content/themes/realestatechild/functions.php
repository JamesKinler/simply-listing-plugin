<?php
function jk_theme_styles(){
    wp_enqueue_style( 'style_css', get_stylesheet_directory_uri() . '/style.css');



}

add_action('wp_enqueue_scripts','jk_theme_styles');








 ?>
