<?php

/**
* Add REST API support to the Features post type and make it hierarchical.
*/

function features_make_hierarchical_restful($args) {
  $new_args = array(
    'show_in_rest' => true,
    'hierarchical' => true
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
