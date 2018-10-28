<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Add REST API support to the Features post type and make it hierarchical.
*/

function features_make_hierarchical_restful($args) {
  $new_args = array(
    'show_in_rest' => true,
    'hierarchical' => true,
    'description'        => __( 'The services we provide', 'finkom_helper_functions' )

  );
  $args = array_merge($args, $new_args);
  return $args;
}

add_filter('woothemes_features_post_type_args', 'features_make_hierarchical_restful');



function change_woothemes_features_single_slug($single_slug) {
  $single_slug = _x( 'service', 'single post url slug', 'finkom_helper_functions' );

  return $single_slug;
}

add_filter('woothemes_features_single_slug', 'change_woothemes_features_single_slug');

function change_woothemes_features_archive_slug($single_slug) {
  $single_slug = _x( 'services', 'post archive url slug', 'finkom_helper_functions' );

  return $single_slug;
}
add_filter('woothemes_features_archive_slug', 'change_woothemes_features_archive_slug');

# Filter the post type archive title.
// add_filter( 'post_type_archive_title', 'ccp_post_type_archive_title', 5, 2 );

function fhf_feature_archive_title($title) {
  $newTitle = fhf_feature_get_title_setting();
  if ( is_post_type_archive('feature') ) {
    if ($newTitle) {
      $title = $newTitle;
    }
    else {
      $title = post_type_archive_title( '', false );
    }
  }
  return $title;
}
add_filter( 'get_the_archive_title', 'fhf_feature_archive_title' );

function fhf_feature_archive_description($description) {
  $newdesc = fhf_feature_get_description_setting();
  if ( is_post_type_archive('feature') && ($newdesc) ) {
    $description = $newdesc;
  }
  return $description;
}
add_filter( 'get_the_post_type_description', 'fhf_feature_archive_description' );
