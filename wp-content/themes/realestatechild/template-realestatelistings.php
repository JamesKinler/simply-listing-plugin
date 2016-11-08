<?php /* Template Name: realestate_listings */ ?>
<?php get_header();?>



<div class="container archive__container">
    <div class="row">



<?php
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $archive_query = new WP_Query([
  'post_type' => 'realestate_listings',
  'posts_per_page' => 5,
  'paged' => $paged,
]);


if ( $archive_query->have_posts() ) : while ( $archive_query-> have_posts() ) : $archive_query->the_post(); //start the loop

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
            <div class="col-sm-5 img_heigth">
              <?php the_post_thumbnail('medium', ['class' => 'img-responsive']); ?>
            </div>
            <div class="col-xs-6 archive__info">
              <h1><strong><?php the_title(); ?></strong></h1>
              <?php if(isset($address, $city, $state, $zipcode)){
                echo '<p>' . $address . ', ' . ' ' . $city . ',' . ' ' . $state . ' ' . $zipcode .  '</p>';
              }

              if(isset($price)){
                echo '<p>' . $price .  '</p>';
              }

              if(isset($bedroom, $bathroom)){
                echo '<p>' . 'bd' . ' ' . $bedroom  . ' ' . 'ba' . ' ' . $bathroom . '</p>';
              }

              ?>
            </div>
          </div>
        </div>

      </div>
    </a>




<?php endwhile;
if (function_exists(custom_pagination)) {
  custom_pagination($archive_query->max_num_pages,"",$paged);
}

wp_reset_postdata();
else:
?>

<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

<?php

endif;


?>

    </div>
</div>

<?php get_footer(); ?>
