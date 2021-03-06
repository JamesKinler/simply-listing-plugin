<!DOCTYPE html>
<html lang="en">
<head>

<?php wp_head(); ?>

</head>

<?php $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>

  <header class="header-wrap" style="background: url('<?php echo $backgroundImg[0];?>'); background-size:cover; background-repeat:no-repeat; height:600px;">
    <div class="entery-header">
        <h1 class="entery-title"><?php the_title(); ?></h1>
        <button class="button" type="button" name="button">View Photos</button>
        <button class="squish"type="button" name="squish"><img src="<?php echo plugin_dir_url(__FILE__); ?>/img/arrowsquishs.svg" alt="" /></button>
    </div>
  </header>




<?php if (have_posts()) : while (have_posts()) : the_post(); //start the loop ?>



<div class="container-fluid">
  <div class="row no-gutter img_height">
      <?php $images = get_post_meta(get_the_ID(), 'vdw_gallery_id', true); ?>
        <?php
          foreach ($images as $image) {
            echo "<div class='col-lg-1 img_size'>" . wp_get_attachment_link($image, 'full') . "</div>";
            // echo wp_get_attachment_image($image, 'large');
          }

          ?>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
    <?php
    $address = esc_html(get_post_meta(get_the_ID(),'addresss_input', true));
    $city = esc_html(get_post_meta(get_the_ID(), 'city_input', true));
    $state = esc_html(get_post_meta(get_the_ID(), 'state_input', true));
    $zipcode = esc_html(get_post_meta(get_the_ID(), 'zipcode_input', true));
    $bedroom = esc_html(get_post_meta(get_the_ID(), 'bedroom_input',true));
    $bathroom = esc_html(get_post_meta(get_the_ID(), 'bathroom_input', true));
    $sq_ft = esc_html(get_post_meta(get_the_ID(), 'sqft_input', true));
    $price = esc_html(get_post_meta(get_the_ID(), 'price_input', true));
    $map = get_post_meta(get_the_ID(), 'map', true);
    $MLS = esc_html(get_post_meta(get_the_ID(), 'MLS_input', true));
    $yearbuilt = esc_html(get_post_meta(get_the_ID(), 'yearbuilt_input', true));
    $agent = esc_html(get_post_meta(get_the_ID(), 'agent_input', true));
    $agent_number = esc_html(get_post_meta(get_the_ID(), 'agent_number_input', true));
    $agent_email = esc_html(get_post_meta(get_the_ID(), 'agent_email_input', true));



    if(isset($address, $state, $city, $zipcode)){
      echo "<h1 class='address'>" . $address .  ',' . ' ' . $city . ',' . ' ' . $state . ' ' . $zipcode . "</h1>";
    }

    if(isset($bedroom, $bathroom, $sq_ft)){
      echo "<p class='feature'><strong>" . $bedroom . ' ' . 'Bedroom' . ' - ' . $bathroom . ' ' . 'Baths' . ' - ' . $sq_ft . ' ' . 'Sq Ft' . "</strong></p>";
    }

    if(isset($MLS, $yearbuilt)){
      echo '<p>' . 'MLS#' . ' ' . $MLS . ' ' . ' - ' . 'Year Built' . ' ' . $yearbuilt . '</p>';
    }

    ?>


      <div class="content__listings">
        <?php the_content();?>
      </div>
      <h1 class="agent__heading">Real Estate Agents Info</h1>
      <?php
        if(isset($agent, $agent_number, $agent_email)){
          echo '<p class="agent__info">' . 'Agent' . ' ' . $agent . ' ' . ' - ' . 'Phone Number' . ' ' . '<a href="tel:' . $agent_number .'">' . $agent_number . '</a>' . ' - ' . '<a href="mailto:' . $agent_email . '"> Contact Me </a> </p>';
        }
      ?>
      <div class="map">
        <?php
        if(isset($map)){
          echo $map;
          echo wp_oembed_get($map);
        }
        ?>
      </div>
    </div>
    <div class="col-lg-2">
      <h1 class="listing__type">
        <?php $categories = wp_get_post_terms($post->ID, 'property_types', ['fields'=>'all']);
          if ( ! empty( $categories ) ) {
          echo esc_html( $categories[0]->name );
        }
        ?>
    </h1>

      <?php
        if(isset($price)){
          echo '<h1 class="price">' . $price . '</h1>';
        }

        $terms = wp_get_post_terms($post->ID, 'features_tags', array("fields" => "all"));

        if ($terms) {
            echo '<h1 class="features"><strong>Features</strong></h1> ';
            foreach ($terms as $term) {
                echo '<a href="' . get_option('siteurl') . '/' . $term->slug . '" title="' . sprintf( __( "Learn more about the %s" ), $term->name ) . '"' . '>' . $term->name.'</a><br />
        ';
                }
      }
      ?>


    </div>
    <div class="col-lg-4 sidebar">
        <?php load_template ( dirname( __FILE__ ) . '/sidebar-home.php' ) ;?>
    </div>
  </div>
</div>




<?php

endwhile; endif; // End the loop

?>





<?php get_footer(); ?>
