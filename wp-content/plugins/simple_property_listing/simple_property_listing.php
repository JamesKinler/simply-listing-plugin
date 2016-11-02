<?php

/*
*Plugin Name: WP Simple Realty
*Plugin URI: teammahout.com
*Description: Easy to use real estate listing plugin. Lets you add galleries for your house and all the text information you need to list it
*Version: 1.0
*Author: James Kinler
*/






require_once 'gallery-metabox/gallery.php';

foreach ($images as $image) {
  echo wp_get_attachment_link($image, 'large');
  // echo wp_get_attachment_image($image, 'large');
}

$images = get_post_meta($realestate->ID, 'vdw_gallery_id', true);


add_action('init', 'jk_listing');

function jk_listing(){
  register_post_type('realestate_listings', [
    'labels' => [
      'name' => 'Listings',
      'singular_name' => 'Listing',
      'add_new_item' => 'Add A New Listing',
      'add_new' => 'Add A New Listing',
      'edit_item' => 'Edit Listing',
      'new_item' => 'New Listing',
      'view_item' => 'View Listing',
      'search_item' => 'Search Listings',
      'not_found' => 'No Listings Found',
      'featured_image' => 'Featured Listing Image',
      'not_found_in_trash' => 'No Listings Found In The Trash',
      'parent_item_colon' => 'Parent Listings'
    ],
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-admin-home',
    'publicly_queryable' => true,
    'query_var' => true,
    'supports' => [
      'title', 'editor', 'thumbnail'
    ],
    'taxonomies' => ['category', 'post_tag'],
  ]);
}


function listings_taxonomy(){
  $labels = [
    'name' => 'Listing Categories',
    'singular_name' => 'Category',
    'search_items' => 'Search Categories',
    'all_items' => 'All Categories',
    'parent_item_colon' => 'Parent Categories',
    'edit_item' => 'Edit Categories',
    'update_item' => 'Update Categories',
    'add_new_item' => 'Add New Category',
    'new_item_name' => 'New Name Category',
    'menu_name' => 'Categories',
  ];

  $args = [
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
  ];

  register_taxonomy('category', 'realestate_listings', $args);

}

add_action('admin_init', 'my_admin');

function my_admin(){
  add_meta_box('realestate_listings_metabox',
  'Property Details',
  'display_realestate_listings_metabox',
  'realestate_listings',
  'normal',
  'high');
}





function display_realestate_listings_metabox($realestate){

  //Retrieves or displays the nonce hidden form field.
  wp_nonce_field(basename(__FILE__), "meta-box-nonce");

  $agent = esc_html(get_post_meta($realestate->ID, 'agent_input', true));

  $agent_number = esc_html(get_post_meta($realestate->ID, 'agent_number_input', true));

  $agent_email = esc_html(get_post_meta($realestate->ID, 'agent_email_input', true));

  $address = esc_html(get_post_meta($realestate->ID, 'addresss_input', true));

  $map = esc_html(get_post_meta($realestate->ID, 'map', true));

  $sq_ft = esc_html(get_post_meta($realestate->ID, 'sqft_input', true));

  $bedroom = esc_html(get_post_meta($realestate->ID, 'bedroom_input', true));

  $bathroom = esc_html(get_post_meta($realestate->ID, 'bathroom_input', true));

  $city = esc_html(get_post_meta($realestate->ID, 'city_input', true));

  $state = esc_html(get_post_meta($realestate->ID, 'state_input', true));

  $zipcode = esc_html(get_post_meta($realestate->ID, 'zipcode_input', true));

  $price = esc_html(get_post_meta($realestate->ID, 'price_input', true));

  $yearbuilt = esc_html(get_post_meta($realestate->ID, 'yearbuilt_input', true));

  $MLS = esc_html(get_post_meta($realestate->ID, 'MLS_input', true));




?>
<div class="first__column">
  <label>Real Estate Agent: </label>
  </br>
  <input type="text" size="30" name="realestate_agent" value="<?php echo $agent; ?>">
  </br>
  <label class="spacing" for="">Agent Phone Number: </label>
  </br>
  <input type="text" size="30" name="agent_number" value="<?php echo $agent_number; ?>">
  </br>
  <label>Agents Email:</label>
  </br>
  <input type="text" name="agent_email" value="<?php echo $agent_email; ?>">
  </br>
  <label>Address:</label>
  </br>
  <input type="text" size="30" name="address" value="<?php echo $address ?>">
  </br>
  <label>Map:</label>
  </br>

  <textarea name="google_map" type="text" rows="3" cols="29"><?php  echo $map ?></textarea>
  </br>
  <label>Sq Ft:</label>
  </br>
  <input type="text" size="30" name="sq_ft" value="<?php echo $sq_ft ?>">
  </br>
  <label>Bedrooms</label>
  </br>
  <input type="text" size="30" name="bedroom" value="<?php echo $bedroom ?>">
  </br>
  <label>Bathroom</label>
  </br>
  <input type="text" size="30" name="bathroom" value="<?php echo $bathroom ?>">
</div>

<div class="second__column">
  <label>City</label>
  </br>
  <input type="text" size="30" name="city" value="<?php echo $city ?>">
  </br>
  <label>State</label>
  </br>
  <input type="text" size="30" name="state" value="<?php echo $state ?>">
  </br>
  <label>Zip Code</label>
  </br>
  <input type="text" size="30" name="zipcode" value="<?php echo $zipcode ?>">
  </br>
  <label>Price</label>
  </br>
  <input type="text" size="30" name="price" value="<?php echo $price ?>">
  </br>
  <label>Year Built</label>
  </br>
  <input type="text" size="30" name="yearbuilt" value="<?php echo $yearbuilt ?>">
  </br>
  <label>MLS</label>
  </br>
  <input type="text" size="30" name="MLS" value="<?php echo $MLS ?>">
</div>

<div class="clear">

</div>




<?php

}

add_action('save_post', 'add_property_detail_listings', 10,2);



function allow_multisite_tags($multisite_tags){
  $multisite_tags['iframe'] = [
    'id' => true,
    'src' => true,
    'width' => true,
    'height' => true,
    'frameborder' => true,
    'scrolling' => true
  ];
  return $multisite_tags;
}

add_filter('wp_kses_allowed_html', 'allow_multisite_tags');

function add_property_detail_listings($realestate_id, $realestate){
    //checks the metabox nonce and then returns it
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
       return $realestate_id;
      //checks the user and gives them the ability to edit the post
    if(!current_user_can("edit_post", $realestate_id))
          return $realestate_id;
        //then saves
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
            return $realestate_id;


  // First It Is Going To Check Post Type Of The Listings
  if($realestate->post_type == 'realestate_listings'){
    //We Are Going To Save The Data Of The Agent Input and Sanitize it
    if(isset($_POST['realestate_agent'])&& $_POST['realestate_agent'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['realestate_agent']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'agent_input', $mydata);
    }
      //We Are Going To Save The Data Of The Agent Number Input and Sanitize it
    if(isset($_POST['agent_number']) && $_POST['agent_number'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['agent_number']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'agent_number_input', $mydata);
    }
    //We are going to save the data of the Agent Email Input and Sanitize it
    if(isset($_POST['agent_email']) && $_POST['agent_email'] != ''){
      //This Santize The Input Text Field
      $mydata = sanitize_text_field($_POST['agent_email']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'agent_email_input', $mydata);
    }
    //We Are Going To Save The Data Of The Address Input and Sanitize it
    if(isset($_POST['address']) && $_POST['address'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['address']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'addresss_input', $mydata);
    }
      //We Are Going To Save The Data Of The Map Input and Sanitize it
    if(isset($_POST['google_map']) && $_POST['google_map'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['google_map']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'map', $_POST['google_map'], $mydata);
    }
    //We Are Going To Save The Data Of The Sq Ft. Input and Sanitize it
    if(isset($_POST['sq_ft']) && $_POST['sq_ft'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['sq_ft']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'sqft_input', $mydata);
    }
    //We Are Going To Save The Data Of The Bedroom Input and Sanitize it
    if(isset($_POST['bedroom']) && $_POST['bedroom'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['bedroom']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'bedroom_input', $mydata);
    }
    //We Are Going To Save The Data Of The Bathroom Input and Sanitize it
    if(isset($_POST['bathroom']) && $_POST['bathroom'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['bathroom']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'bathroom_input', $mydata);
    }
    //We Are Going To Save The Data Of The City Input and Sanitize it
    if(isset($_POST['city']) && $_POST['city'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['city']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'city_input', $mydata);
    }
    //We Are Going To Save The Data Of The State Input and Sanitize it
    if(isset($_POST['state']) && $_POST['state'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['state']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'state_input', $mydata);
    }
    //We Are Going To Save The Data Of The Zipcode Input and Sanitize it
    if(isset($_POST['zipcode']) && $_POST['zipcode'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['zipcode']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'zipcode_input', $mydata);
    }
    //We Are Going To Save The Data Of The Price Input and Sanitize it
    if(isset($_POST['price'])&& $_POST['price'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['price']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'price_input', $mydata);
    }
    //We Are Going To Save The Data Of The Year Built  Input and Sanitize it
    if(isset($_POST['yearbuilt']) && $_POST['yearbuilt'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['yearbuilt']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'yearbuilt_input', $mydata);
    }
    //We Are Going To Save The Data Of The MLS Input and Sanitize it
    if(isset($_POST['MLS']) && $_POST['MLS'] != ''){
      // This Santizes The Input Text Field
      $mydata = sanitize_text_field($_POST['MLS']);
      // Then We Update The Post Meta
      update_post_meta($realestate_id, 'MLS_input', $mydata);
    }



  }


}

// this is the styles for the plugin

function myplugin_styles(){

    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.css', [], '1.0', 'all');

    wp_enqueue_style('mystyles', plugin_dir_url(__FILE__) . 'css/mystyles.css', [], '1.0', 'all');

}

add_action( 'wp_enqueue_scripts', 'myplugin_styles' );

//this is the javescripts file for the plugin

function myplugin_scripts(){
  wp_register_script( 'my_js', plugin_dir_url(__FILE__) . '/js/myjs.js', array('jquery'), '', true);
  wp_enqueue_script( 'my_js');
}


add_action( 'wp_enqueue_scripts', 'myplugin_scripts' );

// This saves the styles.css style sheet for the admin plugin
function myadmin_scripts(){

    wp_enqueue_style( 'stylesheet',  plugin_dir_url( __FILE__ ) . 'css/admin.css', [], '1.0', 'all');

}

add_action( 'admin_enqueue_scripts', 'myadmin_scripts' );

add_filter('template_include', 'include_template_function', 1);

function include_template_function($template_path){
  //Checks to see if is simple property listings single page
  if(get_post_type() == 'realestate_listings'){
    //If is Single Page First Check To See If Theme File 'single-simple_proerty_listing.php exists' If It doesn't then use the default from the Plugin
    if (is_single()){
      if($theme_file = locate_template(['simple_property_listing_page.php'])){
        $template_path = $theme_file;
      }else {
        // Default location from the plugin
        $template_path = plugin_dir_path(__FILE__) . '/simple_property_listing_page.php';
      }
    }
  }
  return $template_path; // Return Template Path
}


add_filter('template_include', 'include_archive_template_function');

function include_archive_template_function($template_path){
  if(get_post_type() == 'realestate_listings'){
    if (is_archive()){
      if($theme_file = locate_template(['archive-realestate_listings.php'])){
        $template_path = $theme_file;
      }else{
        $template_path = plugin_dir_path(__FILE__) . '/archive-realestate_listings.php';
      }
    }
  }
  return $template_path;
}

?>
