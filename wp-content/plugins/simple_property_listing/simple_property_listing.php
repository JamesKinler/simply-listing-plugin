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

// adding custom post type
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
    'taxonomies' => ['property_types', 'features_tags'],
  ]);
}

// this adds a custom category;

add_action('init', 'listings_taxonomy', 0);

function listings_taxonomy(){
  $labels = [
    'name' => 'Listing Property Types',
    'singular_name' => 'Property Type',
    'search_items' => 'Search Property Types',
    'all_items' => 'All Categories',
    'parent_item_colon' => 'Parent Property Types',
    'edit_item' => 'Edit Property Types',
    'update_item' => 'Update Property Types',
    'add_new_item' => 'Add New Property Types',
    'new_item_name' => 'New Name Property Types',
    'menu_name' => 'Property Types',
  ];

  $args = [
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
  ];

  register_taxonomy('property_types', 'realestate_listings', $args);

}


//custom taxonomies for tidy_diagnose

add_action('init', 'custom_tag_taxonomy', 0);

function custom_tag_taxonomy(){
  $labels = [
    'name' => 'Features',
    'singular_name' => 'Feature',
    'search_items' =>  'Search Features',
    'popular_items' => 'Popular Features',
    'all_items' => 'All Features',
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => 'Edit Features',
    'update_item' => 'Update Features',
    'add_new_item' => 'Add New Features',
    'new_item_name' => 'New Feature Name',
    'separate_items_with_commas' => 'Separate Features with commas',
    'add_or_remove_items' => 'Add or remove Features',
    'choose_from_most_used' => 'Choose from the most used Features',
    'menu_name' => 'Features',
  ];

  $args = [
    'hierarchical' => false,
    'labels' => $labels,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => ['slug' => 'Features'],
  ];

  register_taxonomy('features_tags',['realestate_listings'], $args);

}

// meta box for inputs

add_action('admin_init', 'my_admin');

function my_admin(){
  add_meta_box('realestate_listings_metabox', //name of meta box
  'Property Details', // label of meta box
  'display_realestate_listings_metabox', // function name
  'realestate_listings', // post type
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

function jk_excerpt_length( $length) {
        return 20;
    }
    add_filter( 'excerpt_length', 'jk_excerpt_length', 999 );



    function jk_excerpt_more( $more ) {
      return ' .....';
  }
  add_filter( 'excerpt_more', 'jk_excerpt_more' );

// this is the styles for the plugin

function myplugin_styles(){

    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.css', [], '1.0', 'all');

    wp_enqueue_style('chosen', plugin_dir_url(__FILE__) . 'css/chosen.css', [], '1.0', 'all');

    wp_enqueue_style('mystyles', plugin_dir_url(__FILE__) . 'css/mystyles.css', [], '1.0', 'all');

}

add_action( 'wp_enqueue_scripts', 'myplugin_styles' );

//this is the javescripts file for the plugin

function myplugin_scripts(){

  wp_register_script('matchHeigth', plugin_dir_url(__FILE__) . 'js/jquery.matchHeight.js',array('jquery'), '',true);
  wp_enqueue_script('matchHeigth');

  wp_register_script('chosen', plugin_dir_url(__FILE__) . 'js/chosen.jquery.js',array('jquery'), '',true);
  wp_enqueue_script('chosen');

  wp_register_script( 'my_js', plugin_dir_url(__FILE__) . 'js/myjs.js', array('jquery'), '', true);
  wp_enqueue_script( 'my_js');



}
add_action( 'wp_enqueue_scripts', 'myplugin_scripts' );


//this loads jquery into the admin panel

function admin_script($hook) {
  if ( 'widgets.php' == $hook || 'post.php' == $hook || 'post-new.php' == $hook ) {

    wp_enqueue_style('admin_widget', plugin_dir_url(__FILE__) . 'css/admin_widget.css', [], '1.0', 'all');

    wp_register_script( 'admin_js', plugin_dir_url(__FILE__) . 'js/admin.js', array('jquery'), '', true);
    wp_enqueue_script( 'admin_js');




  }
}
add_action('admin_enqueue_scripts', 'admin_script');


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


function simple_property_listing_shortcode($atts){


  $output ='';

  $custom_loop_atts = shortcode_atts([
    'number_of_posts' => 1,
    'type' => 'realestate_listings'
  ],$atts);


  $post_type = $custom_loop_atts['type'];
  $number_of_posts = $custom_loop_atts['number_of_posts'];


  $args = [
    'post_type' => $post_type,
    'post_status' => 'publish',
    'order' => 'date',
    'posts_per_page' => $number_of_posts,
  ];

  $shortcode_query = new WP_Query($args);


  $output .= '<div class="container archive__container">';
    $output .= '<div class="row">';




  while($shortcode_query->have_posts()) : $shortcode_query->the_post();
  $post_id = get_the_ID();
    $output .= '<a href=';
    $output .= get_the_permalink();
    $output .= '>';
      $output .= '<div class="col-lg-4">';
        $output .= '<div class="container__border">';
          $output .= '<div class="row">';
            $output .= '<div class="col-sm-5 img_heigth">';
              $output .= get_the_post_thumbnail($post_id, 'medium', ['class' => 'img-responsive']);
            $output .= '</div>';
            $output .= '<div class="col-xs-6 archive__info">';
              $output .= '<h1>';
                $output .= '<strong>';
                  $output .= get_the_title();
                $output .= '</strong>';
              $output .= '</h1>';
              $output .= '<p>';
                $output .= esc_html(get_post_meta($post_id, 'addresss_input', true));
                $output .= ', ';
                $output .= esc_html(get_post_meta($post_id,'city_input',true));
                $output .=', ';
                $output .= esc_html(get_post_meta($post_id, 'state_input',true));
                $output .= ' ';
                $output .= esc_html(get_post_meta($post_id, 'zipcode_input', true));
              $output .= '</p>';
              $output .= '<p>';
                $output .= esc_html(get_post_meta($post_id, 'price_input', true));
              $output .= '</p>';
              $output .= '<p>';
                $output .= 'bd ';
                $output .= esc_html(get_post_meta($post_id, 'bedroom_input', true));
                $output .= ' ';
                $output .= 'ba ';
                $output .= esc_html(get_post_meta($post_id, 'bathroom_input', true));
              $output .= '</p>';
            $output .= '</div>';
          $output .= '</div>';
        $output .= '</div>';
      $output .= '</div>';
    $output .= '</a>';
  endwhile;

  $output .= '</div>';
$output .= '</div>';
  return $output;
  wp_reset_postdata();



}

add_shortcode('listings', 'simple_property_listing_shortcode');

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


// Creating the widget
class wp_simpley_realestate extends WP_Widget {
  public function __construct(){
    parent::__construct(
      'simpley_realestate_widget', //Base ID
      'Simpley Realesate Widget', //name
      ['description' => __('Displays your latest listings')]
    );
  }

  //this is the form inputs for the widgets
  public function form($instance){
    if($instance){
      $numberOfListings = esc_attr($instance['numberOfListings']);
      $imagecheckbox = esc_attr($instance['ImagecheckBox']);
      $theTitle = esc_attr($instance['headerCheckbox']);
      $street = esc_attr($instance['streetCheckbox']);
      $price = esc_attr($instance['priceCheckbox']);
      $rooms = esc_attr($instance['roomCheckbox']);
      $theExcerpt = esc_attr($instance['excerptCheckbox']);
      $category = esc_attr($instance['category']);
      $tags = esc_attr($instance['tags']);



    }else{
      $numberOfListings = '';
      $imagecheckbox = '';
      $theTitle = '';
      $street = '';
      $price = '';
      $rooms = '';
      $theExcerpt = '';
      $category = '';
      $tags = '';
    }
    ?>
  <p>
    <div class="wprs__accordion">
      <div class="wprs__accordion__section">
        <h3 class="wprs__accordion__header"><a  class="wprs__accordion__section__title wprs__arrow"href="#wprs__accordion-1"
          aria-hidden="true">Property Types Filters</a></h3>
        <div class="wprs__accordion__section__content" id="wprs__accordion-1">
              <p class="wprs__categories__discription">Use the following property listings to show what property listings you would like to display. You could select one property listing or all of them. </p>
              <div class="wpsr__house__features">
                <?php
                  $category = (isset($instance['category']) ? array_map('absint', $instance['category']) : ["0"]);
                  $terms = get_terms([
                  'taxonomy' => 'property_types',
                  ]);
                  foreach($terms as $term) :
                ?>
                <label for="<?php echo $this->get_field_id('category'. $term->term_id) ; ?>" >
                  <input  type="checkbox"
                    id="<?php echo $this->get_field_id('category' . $term->term_id); ?>"
                    name="<?php echo $this->get_field_name('category' . '[]'); ?>"
                    <?php   if (isset($term->term_id)) {
                              if (in_array($term->term_id,$category))
                                  echo 'checked';
                        };
                    ?>
                    value="<?php echo $term->term_id; ?>" />
                    <?php echo $term->name ?>
              </label>
                  <?php endforeach; ?>
            </div>
        </div><!--end .accordion section content-->
      </div><!--end .accordion section-->
    </div><!--end .accordion-->




      <!-- you can choose how many posts you want to show -->
    <label for="<?php echo $this->get_field_id('numberOfListings'); ?>"><?php _e('Number of Listings:', 'simpley_realestate_widget'); ?></label>
    <select id="<?php echo $this->get_field_id('numberOfListings'); ?>"  name="<?php echo $this->get_field_name('numberOfListings'); ?>">
			<?php for($x='';$x<=10;$x++): ?>
			<option <?php echo $x == $numberOfListings ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
			<?php endfor;?>
		</select>
    </br>
    </br>

    <!-- this is the label input checkbox for image to be displayed if checked it will display the image -->
    <label for="<?php echo $this->get_field_id('ImagecheckBox'); ?>"><?php _e(' Check the box if you want the image to be displayed:', 'simpley_realestate_widget')?></label>
    <input id="<?php echo $this->get_field_id('ImagecheckBox'); ?>" name="<?php echo esc_attr($this->get_field_name('ImagecheckBox'));?>" type="checkbox" value="1" <?php checked('1', $imagecheckbox); ?>/>
    </br>
    </br>

    <!-- this is the label input checkbox for the title of the listing to be displayed if checked it will display the image -->
    <label for="<?php echo $this->get_field_id('headerCheckbox'); ?>"><?php _e(' Check the box if you want the title to be displayed:', 'simpley_realestate_widget')?></label>
    <input id="<?php echo $this->get_field_id('headerCheckbox'); ?>" name="<?php echo esc_attr($this->get_field_name('headerCheckbox'));?>" type="checkbox" value="1" <?php checked('1', $theTitle); ?>/>
    </br>
    </br>

    <!-- this is the label input checkbox for street to be displayed if checked it will display the image -->
    <label for="<?php echo $this->get_field_id('streetCheckbox'); ?>"><?php _e(' Check the box if you want the address to be displayed:', 'simpley_realestate_widget')?></label>
    <input id="<?php echo $this->get_field_id('streetCheckbox'); ?>" name="<?php echo esc_attr($this->get_field_name('streetCheckbox'));?>" type="checkbox" value="1" <?php checked('1', $street); ?>/>
    </br>
    </br>

    <!-- this is the label input checkbox for price to be displayed if checked it will display the image -->
    <label for="<?php echo $this->get_field_id('priceCheckbox'); ?>"><?php _e(' Check the box if you want the price to be displayed:', 'simpley_realestate_widget')?></label>
    <input id="<?php echo $this->get_field_id('priceCheckbox'); ?>" name="<?php echo esc_attr($this->get_field_name('priceCheckbox'));?>" type="checkbox" value="1" <?php checked('1', $price); ?>/>
    </br>
    </br>

    <!-- this is the label input checkbox for bedroom and bathroom to be displayed if checked it will display the image -->
    <label for="<?php echo $this->get_field_id('roomCheckbox'); ?>"><?php _e(' Check the box if you want the bedroom and bathrooms to be displayed:', 'simpley_realestate_widget')?></label>
    <input id="<?php echo $this->get_field_id('roomCheckbox'); ?>" name="<?php echo esc_attr($this->get_field_name('roomCheckbox'));?>" type="checkbox" value="1" <?php checked('1', $rooms); ?>/>
    </br>
    </br>

    <!-- this is the label input checkbox for excerpt to be displayed if checked it will display the image -->
    <label for="<?php echo $this->get_field_id('excerptCheckbox'); ?>"><?php _e(' Check the box if you want an excpert to be displayed:', 'simpley_realestate_widget')?></label>
    <input id="<?php echo $this->get_field_id('excerptCheckbox'); ?>" name="<?php echo esc_attr($this->get_field_name('excerptCheckbox'));?>" type="checkbox" value="1" <?php checked('1', $theExcerpt); ?>/>
    </br>
    </br>

  </p>
  <?php
  }
  //This function is about updating the widget when adding a new instance
  public function update($new_instance, $old_instance) {
  	$instance = $old_instance;
  	$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
    $instance['ImagecheckBox'] = strip_tags($new_instance['ImagecheckBox']);
    $instance['headerCheckbox'] = strip_tags($new_instance['headerCheckbox']);
    $instance['streetCheckbox'] = strip_tags($new_instance['streetCheckbox']);
    $instance['priceCheckbox'] = strip_tags($new_instance['priceCheckbox']);
    $instance['roomCheckbox'] = strip_tags($new_instance['roomCheckbox']);
    $instance['excerptCheckbox'] = strip_tags($new_instance['excerptCheckbox']);
    $instance['category'] =  (isset($new_instance['category']) ? array_map( 'absint', $new_instance['category']) : ["0"]);
    $instance['tags'] =  (isset($new_instance['tags']) ? array_map( 'absint', $new_instance['tags']) : ["0"]);
  	return $instance;
  }
  // This is outputing everything in the widget
  public function widget($args,$instance){

      $numberOfListings = $instance['numberOfListings'];
      $category = $instance['category'];
      $tags = $instance['tags'];
      print_r($category);

      $custom_post_category = $term_list[0]->term_id;
        $query_args = [
          'post_type' => 'realestate_listings',
          'posts_per_page' => $numberOfListings,
          'order' => 'date',
          'tax_query' => [[
            'taxonomy' => 'property_types',
            'field' => 'id',
            'terms' => $category,
          ],
        [
          'taxonomy' => 'features_tags',
          'field' => 'id',
          'terms' => $tags,
          ]]

        ];
        ?>
      <div class="container archive__container">
        <div class="row flex-row">
        <?php
        $widget_query = new WP_Query($query_args);
        while($widget_query->have_posts()) : $widget_query->the_post();
        //Sets a instance to turn off and on
        $imagecheckbox = $instance['ImagecheckBox'];
        $theTitle = $instance['headerCheckbox'];
        $street = $instance['streetCheckbox'];
        $price = $instance['priceCheckbox'];
        $room = $instance['roomCheckbox'];
        $theExcerpt = $instance['excerptCheckbox'];
        $test = $instance['test'];

        //these are the meta vaules from the meta box
        $address = esc_html(get_post_meta(get_the_ID(), 'addresss_input',true));
        $state = esc_html(get_post_meta(get_the_ID(), 'state_input',true));
        $city = esc_html(get_post_meta(get_the_ID(), 'city_input', true));
        $zipcode = esc_html(get_post_meta(get_the_ID(), 'zipcode_input', true));
        $price = esc_html(get_post_meta(get_the_ID(), 'price_input',true));
        $bedroom = esc_html(get_post_meta(get_the_ID(), 'bedroom_input',true));
        $bathroom = esc_html(get_post_meta(get_the_ID(), 'bathroom_input', true));
        ?>
        <a href="<?php the_permalink(); ?>">
        <div class="col-lg-4">
          <div class="container__border">
            <div class="row">
              <?php
              if($imagecheckbox == '1'){
                ?>
              <div class="col-sm-5 img_heigth">
                  <?php the_post_thumbnail('medium', ['class' => 'img-responsive']); ?>
              </div>
              <?php
            }
              ?>
              <div class="archive__info col-xs-6 empty">
                <?php if($theTitle == '1'){?>
                <h1><strong><?php the_title(); ?></strong></h1>
                <?php } ?>

                <?php
                if($street == '1'){
                  if(isset($address, $city, $state, $zipcode)){
                    echo '<p>' . $address . ', ' . ' ' . $city . ',' . ' ' . $state . ' ' . $zipcode .  '</p>';
                  }
                }
                if($price == '1'){
                  if(isset($price)){
                    echo '<p>' . $price .  '</p>';
                  }
                }
                if($room == '1'){
                  if(isset($bedroom, $bathroom)){
                    echo '<p>' . 'bd' . ' ' . $bedroom  . ' ' . 'ba' . ' ' . $bathroom . '</p>';
                  }
                }

                ?>
              </div>
              <?php if($theExcerpt == '1'){?>
              <div class="col-sm-12 box">
                  <?php the_excerpt();?>
              </div>
              <?php } ?>
            </div>
          </div>
          <?php echo $test; ?>
        </div>
      </a>
  <?php endwhile; ?>
      </div>
    </div>
    <?php
  }

}

add_action('widgets_init', function(){
  register_widget('wp_simpley_realestate');
});
?>
