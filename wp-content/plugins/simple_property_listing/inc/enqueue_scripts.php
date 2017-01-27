<?php




// this is the styles for the plugin
function myplugin_styles(){

    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . '../css/bootstrap.css', [], '1.0', 'all');

    wp_enqueue_style('chosen', plugin_dir_url(__FILE__) . '../css/chosen.css', [], '1.0', 'all');

    wp_enqueue_style('mystyles', plugin_dir_url(__FILE__) . '../css/mystyles.css', [], '1.0', 'all');

}

add_action( 'wp_enqueue_scripts', 'myplugin_styles' );

//this is the javescripts file for the plugin

function myplugin_scripts(){

  wp_register_script('matchHeigth', plugin_dir_url(__FILE__) . '../js/jquery.matchHeight.js',array('jquery'), '',true);
  wp_enqueue_script('matchHeigth');

  wp_register_script('chosen', plugin_dir_url(__FILE__) . '../js/chosen.jquery.js',array('jquery'), '',true);
  wp_enqueue_script('chosen');

  wp_register_script( 'my_js', plugin_dir_url(__FILE__) . '../js/myjs.js', array('jquery'), '', true);
  wp_enqueue_script( 'my_js');

}
add_action( 'wp_enqueue_scripts', 'myplugin_scripts' );


//customizer jquery
function customizer_js(){
  wp_register_script( 'admin_js', plugin_dir_url(__FILE__) . '../js/admin.js', array('jquery'), '', true);
  wp_enqueue_script( 'admin_js');
}

add_action('customize_controls_enqueue_scripts', 'customizer_js');
//this loads jquery into the admin panel

function admin_script($hook) {
  if ( 'widgets.php' == $hook || 'post.php' == $hook || 'post-new.php' == $hook ) {

    wp_enqueue_style('admin_widget', plugin_dir_url(__FILE__) . '../css/admin_widget.css', [], '1.0', 'all');

    wp_register_script( 'admin_js', plugin_dir_url(__FILE__) . '../js/admin.js', array('jquery'), '', true);
    wp_enqueue_script( 'admin_js');

  }
}
add_action('admin_enqueue_scripts', 'admin_script');


// This saves the styles.css style sheet for the admin plugin
function myadmin_scripts(){

    wp_enqueue_style( 'stylesheet',  plugin_dir_url( __FILE__ ) . '../css/admin.css', [], '1.0', 'all');

}

add_action( 'admin_enqueue_scripts', 'myadmin_scripts' );

?>
