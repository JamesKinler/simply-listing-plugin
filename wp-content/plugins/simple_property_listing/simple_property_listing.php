<?php

/*
*Plugin Name: WP Simple Realty
*Plugin URI: teammahout.com
*Description: Easy to use real estate listing plugin. Lets you add galleries for your house and all the text information you need to list it
*Version: 1.0
*Author: James Kinler
*/






require_once ('gallery-metabox/gallery.php');
include ('inc/main.php');
include ('inc/metabox.php');
include ('inc/enqueue_scripts.php');
include ('inc/template_saving.php');
include ('inc/shortcode.php');
include ('inc/widget.php');
include ('inc/misc.php');


// adding a widget area

function realestate_widget_init(){
  register_sidebar([
    // This is the name of the widget
    'name' => 'Front Page Widget',
    // the id of the widget, just the name of the widget lowercase and underscore
    'id' => 'front_page_widget',
    // this is the html code that is going to wrap your widget before
    'before_widget'=>'<section>',
    // this is going to be the code that wraps the end of your widget
    'after_widget' => '</section>',
    // this whats going to wrap your title of your widget
    'before_title' => '<h1>',
    // this is whats going to wrap at the end of the widget
    'after_title' => '</h1>',
  ]);
}

add_action('widgets_init', 'realestate_widget_init');



?>
