<?php

function simple_property_listing_shortcode($atts){




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


  ob_start();
  ?>
    <div class="container archive__container">
      <div class="row">
  <?php




  while($shortcode_query->have_posts()) : $shortcode_query->the_post();
  $post_id = get_the_ID();
  ?>
      <a href="<?php the_permalink();?>">
        <div class="col-lg-4">
          <div class="container__border">
            <div class="row">
              <div class="col-sm-5 img_heigth">
                <?php the_post_thumbnail( 'medium', ['class' => 'img-responsive']); ?>
              </div> <!--end col-sm-5 -->
              <div class="col-xs-6 archive__info">
                <h1><strong><?php the_title();?></strong></h1>
                <p>
                  <?php echo esc_html(get_post_meta($post_id, 'addresss_input', true)); ?>,&nbsp
                  <?php echo esc_html(get_post_meta($post_id,'city_input',true)); ?>,&nbsp
                  <?php echo esc_html(get_post_meta($post_id, 'state_input',true)); ?>,&nbsp
                  <?php echo esc_html(get_post_meta($post_id, 'zipcode_input', true)); ?>
                </p>
                <p>
                  <?php echo esc_html(get_post_meta($post_id, 'price_input', true)); ?>
                </p>
                <p>
                  bd <?php echo esc_html(get_post_meta($post_id, 'bedroom_input', true)); ?>&nbsp
                  br <?php echo esc_html(get_post_meta($post_id, 'bathroom_input', true)); ?>
                </p>
              </div> <!--end col-xs-6 -->
              <div class="col-sm-12 box">
                  <?php the_excerpt();?>
              </div> <!--end col-sm-12 -->
            </div> <!--end of row inside of container-->
          </div> <!--end of container__border-->
        </div> <!--end col-lg-4 -->
      </a> <!--end a of the anchor tag-->
  <?php
  endwhile;
  ?>
  </div><!--end of main row-->
</div><!--end of wrapper-->
<?php
  return ob_get_clean();
  wp_reset_postdata();


}

add_shortcode('listings', 'simple_property_listing_shortcode');

?>
