<?php

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
      'name' => 'Listing',
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


?>
