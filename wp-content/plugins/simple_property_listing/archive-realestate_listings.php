<?php get_header();?>


<div class="container archive__container">
    <div class="row no-gutter">





<?php
if (have_posts()) : while (have_posts()) : the_post(); //start the loop

$address = esc_html(get_post_meta(get_the_ID(), 'addresss_input',true));
$state = esc_html(get_post_meta(get_the_ID(), 'state_input',true));
$city = esc_html(get_post_meta(get_the_ID(), 'city_input', true));
$zipcode = esc_html(get_post_meta(get_the_ID(), 'zipcode_input', true));
$price = esc_html(get_post_meta(get_the_ID(), 'price_input',true));
$bedroom = esc_html(get_post_meta(get_the_ID(), 'bedroom_input',true));
$bathroom = esc_html(get_post_meta(get_the_ID(), 'bathroom_input', true));

?>

      <a href="<?php the_permalink(); ?>">
      <div class="col-lg-4 container__border">
        <div class="row no-gutter">
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
    </a>




<?php endwhile; endif; ?>

    </div>
</div>
<?php get_footer(); ?>
