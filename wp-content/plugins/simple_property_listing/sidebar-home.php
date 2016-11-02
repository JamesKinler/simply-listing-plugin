<?php
  $category = get_the_category();
  $custom_post_category = $category[0]->term_id;

  $realestate_query = new Wp_Query([
    'post_type' => 'realestate_listings',
    'cat' => $custom_post_category,
    'posts_per_page' => 4,
    'orderby' => 'rand',
  ]);

  if ( $realestate_query->have_posts() ) :

  while ($realestate_query->have_posts()) : $realestate_query->the_post();

  $address = esc_html(get_post_meta(get_the_ID(), 'addresss_input',true));
  $state = esc_html(get_post_meta(get_the_ID(), 'state_input',true));
  $city = esc_html(get_post_meta(get_the_ID(), 'city_input', true));
  $zipcode = esc_html(get_post_meta(get_the_ID(), 'zipcode_input', true));
  $price = esc_html(get_post_meta(get_the_ID(), 'price_input',true));
  $bedroom = esc_html(get_post_meta(get_the_ID(), 'bedroom_input',true));
  $bathroom = esc_html(get_post_meta(get_the_ID(), 'bathroom_input', true));
  ?>



  <div class="sidebar__whole">
    <a href="<?php the_permalink(); ?>">
      <div class="sidebar__info">
        <div class="row">
          <div class="col-lg-7">
            <?php the_post_thumbnail('full',['class' => 'img-responsive']);?>
          </div>
          <div class="col-lg-5 sidebar__info">
            <h1><?php the_title(); ?></h1>
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
    </a>
  </div>




<?php
  endwhile;endif;
  wp_reset_postdata();


?>
