<?php

/**
* Add REST API support to the Features post type.
*/
// add_action( 'init', 'finkom_team_rest_support', 25 );
function finkom_team_rest_support() {
  global $wp_post_types;

  //be sure to set this to the name of your post type!
  $post_type_name = 'team-member';
  if( isset( $wp_post_types[ $post_type_name ] ) ) {
    $wp_post_types[$post_type_name]->show_in_rest = true;
  }
}

function members_make_restful($args) {
  $new_args = array(
    'show_in_rest' => true
  );
  $args = array_merge($args, $new_args);
  return $args;
}

add_filter('woothemes_our_team_post_type_args', 'members_make_restful');

function change_woothemes_team_members_single_slug($single_slug) {
	$single_slug = _x( 'partner', 'single post url slug', 'finkom_helper_functions' );

	return $single_slug;
}
add_filter('woothemes_our_team_single_slug', 'change_woothemes_team_members_single_slug');

function change_woothemes_team_members_archive_slug($single_slug) {
	$single_slug = _x( 'partners', 'post archive url slug', 'finkom_helper_functions' );

	return $single_slug;
}
add_filter('woothemes_our_team_archive_slug', 'change_woothemes_team_members_archive_slug');
