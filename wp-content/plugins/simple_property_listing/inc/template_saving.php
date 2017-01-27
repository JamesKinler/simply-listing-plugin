<?php

function include_template_function($template_path){
  //Checks to see if is simple property listings single page
  if(get_post_type() == 'realestate_listings'){
    //If is Single Page First Check To See If Theme File 'single-simple_proerty_listing.php exists' If It doesn't then use the default from the Plugin
    if (is_single()){
      if($theme_file = locate_template(['simple_property_listing_page.php'])){
        $template_path = $theme_file;
      }else {
        // Default location from the plugin
        $template_path = plugin_dir_path(__FILE__) . '../simple_property_listing_page.php';
      }
    }
  }
  return $template_path; // Return Template Path
}

add_filter('template_include', 'include_template_function', 1);

function include_archive_template_function($template_path){
  if(get_post_type() == 'realestate_listings'){
    if (is_archive()){
      if($theme_file = locate_template(['archive-realestate_listings.php'])){
        $template_path = $theme_file;
      }else{
        $template_path = plugin_dir_path(__FILE__) . '../archive-realestate_listings.php';
      }
    }
  }
  return $template_path;
}

add_filter('template_include', 'include_archive_template_function');

?>
