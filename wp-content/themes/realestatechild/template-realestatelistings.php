<?php /* Template Name: realestate_listings */ ?>
<?php get_header();?>



<!-- <?php echo do_shortcode('[listings number_of_posts=5]');?> -->


<?php if(dynamic_sidebar('front_page_widget')) : else : endif?>

  <select class="chosen" multiple="true" style="width:200px;">
  	<option>Choose...</option>
  	<option>jQuery</option>
  	<option selected="selected">MooTools</option>
  	<option>Prototype</option>
  	<option>Dojo Toolkit</option>
  </select>



<?php get_footer(); ?>
