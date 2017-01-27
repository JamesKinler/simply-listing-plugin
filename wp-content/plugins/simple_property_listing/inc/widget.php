<?php

// Creating the widget
class wp_simpley_realestate extends WP_Widget {
  public function __construct(){
    parent::__construct(

      'simpley_realestate_widget', //Base ID
      'Simpley Realesate Widget', //name
      [
        'description' => __('Displays your latest listings'),
      ]
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










    <!-- This section lets you choose what category is displayed in the widget area -->
    <div class="wprs__accordion">
      <div class="wprs__accordion__section">
        <h3 class="wprs__accordion__header">
          <a class="wprs__accordion__section__title wprs__arrow"href="#wprs__accordion-1"
          aria-hidden="true">Property Types Filters
          </a>
        </h3>
        <div class="wprs__accordion__section__content" id="wprs__accordion-1">
              <p class="wprs__categories__discription">Use the following property listings to show what property listings you would like  to display. You could select one property listing or all of them.
              </p>
              <div class="wpsr__house__features">
                  <?php
                    // this is the if statment that lets lets you select what category is choosen
                    $category = (isset($instance['category']) ? array_map('absint', $instance['category']) : ["0"]);
                    $terms = get_terms([
                      // this is grabing the taxonomy naame
                    'taxonomy' => 'property_types',
                    ]);
                    foreach($terms as $term) :
                  ?>
                    <label for="<?php echo $this->get_field_id('category'. $term->term_id) ; ?>" >
                      <input  type="checkbox"
                        id="<?php echo $this->get_field_id('category' . $term->term_id); ?>"
                        name="<?php echo $this->get_field_name('category' . '[]'); ?>"
                        <?php
                          if (isset($term->term_id)) {
                          if (in_array($term->term_id,$category))
                          echo 'checked';
                          };
                        ?>
                        value="
                          <?php
                              echo $term->term_id;
                            ?>"/>
                        <?php
                          echo $term->name
                        ?>
                  </label>
                      <?php endforeach; ?>
              </div>
          </div><!--end .accordion section content-->
        </div><!--end .accordion section-->
      </div><!--end .accordion-->











    <!--  this is a container that displays the tags-->
    <div class="wprs__accordion">
      <div class="wprs__accordion__section">
        <h3 class="wprs__accordion__header">
          <a class="wprs__accordion__section__title wprs__arrow"href="#wprs__accordion-2"
          aria-hidden="true">Featuers Filters
          </a>
        </h3>
        <div class="wprs__accordion__section__content" id="wprs__accordion-2">
              <p class="wprs__categories__discription">Use the following features to show what featuers  you would like to display. You could select one feature or all of them.
              </p>
                  <div class="wpsr__house__features">
                    <?php
                      // this is a if statment that loops over the tags and lets you show the ones that are selected.
                      $tags = (isset($instance['tags']) ? array_map('absint', $instance['tags']) : ["0"]);
                      $terms = get_terms([
                      // this chooses the taxonomy of features tags
                      'taxonomy' => 'features_tags',
                      ]);
                      foreach($terms as $term) :
                    ?>
                    <label for="<?php echo $this->get_field_id('tags'. $term->term_id) ; ?>" >
                      <input  type="checkbox"
                        id="<?php echo $this->get_field_id('tags' . $term->term_id); ?>"
                        name="<?php echo $this->get_field_name('tags' . '[]'); ?>"
                        <?php   if (isset($term->term_id)) {
                                  if (in_array($term->term_id,$tags))
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








    <!-- this container will show how many posts you want to show on the front page-->
    <div class="wprs__accordion">
      <div class="wprs__accordion__section">
        <h3 class="wprs__accordion__header">
          <a class="wprs__accordion__section__title wprs__arrow"href="#wprs__accordion-3"
          aria-hidden="true">Number Of Homes Display
          </a>
        </h3>
        <div class="wprs__accordion__section__content" id="wprs__accordion-3">
              <p class="wprs__categories__discription">Use the following to choose how many homes you want to display.
                <!-- you can choose how many posts you want to show -->
              <select id="<?php echo $this->get_field_id('numberOfListings'); ?>"  name="<?php echo $this->get_field_name('numberOfListings'); ?>">
                <?php
                // this loops over a blank number to 10 and lets choose a number to display how many posts you want to do
                for($x='';$x<=10;$x++):
                ?>
                <option
                  <?php echo $x == $numberOfListings ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?>
                </option>
                <?php endfor;?>
              </select>
              </p>
        </div><!--end .accordion section content-->
      </div><!--end .accordion section-->
    </div><!--.accordion-->











    <!-- this container lets you choose if choose all any item to display -->
    <div class="wprs__accordion">
      <div class="wprs__accordion__section">
        <h3 class="wprs__accordion__header"><a  class="wprs__accordion__section__title wprs__arrow"href="#wprs__accordion-4"
          aria-hidden="true">Display Items </a></h3>
        <div class="wprs__accordion__section__content" id="wprs__accordion-4">
              <p class="wprs__categories__discription">Select What Items You Want To Display.
                <!-- you can choose how many posts you want to show -->
                <div class="wpsr__house__features">

                  <!-- this is the label input checkbox for image to be displayed if checked it will display the image -->
                  <label for="<?php echo $this->get_field_id('ImagecheckBox'); ?>">
                    <input id="<?php echo $this->get_field_id('ImagecheckBox'); ?>"
                          name="<?php echo esc_attr($this->get_field_name('ImagecheckBox'));?>"
                          type="checkbox" value="1"
                          <?php checked('1', $imagecheckbox); ?>/>
                          <?php _e(' Image', 'simpley_realestate_widget')?>
                    </label>


                    <!-- this is the label input checkbox for the title of the listing to be displayed if checked it will display the image -->
                    <label for="<?php echo $this->get_field_id('headerCheckbox'); ?>">
                      <input id="<?php echo $this->get_field_id('headerCheckbox'); ?>"
                              name="<?php echo esc_attr($this->get_field_name('headerCheckbox'));?>"
                              type="checkbox" value="1"
                              <?php checked('1', $theTitle); ?>/>
                              <?php _e(' Header', 'simpley_realestate_widget')?>
                      </label>


                        <!-- this is the label input checkbox for street to be displayed if checked it will display the image -->
                        <label for="<?php echo $this->get_field_id('streetCheckbox'); ?>">
                          <input id="<?php echo $this->get_field_id('streetCheckbox'); ?>"
                                  name="<?php echo esc_attr($this->get_field_name('streetCheckbox'));?>"
                                  type="checkbox" value="1"
                                  <?php checked('1', $street); ?>/>
                                  <?php _e(' Address', 'simpley_realestate_widget')?>
                        </label>


                        <!-- this is the label input checkbox for price to be displayed if checked it will display the image -->
                        <label for="<?php echo $this->get_field_id('priceCheckbox'); ?>">
                            <input id="<?php echo $this->get_field_id('priceCheckbox'); ?>"
                                    name="<?php echo esc_attr($this->get_field_name('priceCheckbox'));?>"
                                    type="checkbox" value="1"
                                    <?php checked('1', $price); ?>/>
                                    <?php _e(' Price', 'simpley_realestate_widget')?>
                        </label>
                        <!-- this is the label input checkbox for bedroom and bathroom to be displayed if checked it will display the image -->
                        <label for="<?php echo $this->get_field_id('roomCheckbox'); ?>">
                          <input id="<?php echo $this->get_field_id('roomCheckbox'); ?>"
                                  name="<?php echo esc_attr($this->get_field_name('roomCheckbox'));?>"
                                  type="checkbox" value="1"
                                  <?php checked('1', $rooms); ?>/>
                                  <?php _e('Bed & Bath')?>
                        </label>

                        <!-- this is the label input checkbox for excerpt to be displayed if checked it will display the image -->
                      <label for="<?php echo $this->get_field_id('excerptCheckbox'); ?>">
                        <input id="<?php echo $this->get_field_id('excerptCheckbox'); ?>"
                                name="<?php echo esc_attr($this->get_field_name('excerptCheckbox'));?>"
                                type="checkbox" value="1"
                                <?php checked('1', $theExcerpt); ?>/>
                                <?php _e('Excerpt', 'simpley_realestate_widget')?>
                    </label>
                </div>
              </p>
        </div><!--end .accordion section content-->
      </div><!--end .accordion section-->
    </div><!--.accordion-->










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


      //this creates a varible for the number listings
      $numberOfListings = $instance['numberOfListings'];
      //this creates a varible for the category
      $category = $instance['category'];
      //this creates a varible for the tags
      $tags = $instance['tags'];


      $custom_post_category = $term_list[0]->term_id;
        //this querys args for the custom query loop
        $query_args = [
          'post_type' => 'realestate_listings',
          //this grabs the number selected in the widget and displays how posts per page
          'posts_per_page' => $numberOfListings,
          'order' => 'date',
          'tax_query' => [
            [
            // this grabs the property types taxonomy and querys over it display whatever ones are selected
            'taxonomy' => 'property_types',
            'field' => 'id',
            // you put the varible you had at the top here.
            'terms' => $category,
          ],
          [
            // this grabs the taxonomy of featured tags query
            'taxonomy' => 'features_tags',
            'field' => 'id',
            // this grabs the tags varible and displays it
            'terms' => $tags,
          ]
        ]

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


        <!-- this the html that displays it all in the widget if selected.-->
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
