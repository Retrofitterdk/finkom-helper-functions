<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Add REST API support to the Features post type.
*/
function members_make_restful($args) {
  $new_args = array(
    'show_in_rest' => true,
    'description'        => __( 'The members of our crew', 'finkom_helper_functions' )

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

function fhf_team_archive_title($title) {
  $newTitle = fhf_team_get_title_setting();
  if ( is_post_type_archive('team-member') ) {
    if ($newTitle) {
      $title = $newTitle;
    }
    else {
      $title = post_type_archive_title( '', false );
    }
  }
  return $title;
}
add_filter( 'get_the_archive_title', 'fhf_team_archive_title' );

function fhf_team_archive_description($description) {
  $newdesc = fhf_team_get_description_setting();
  if ( is_post_type_archive('team-member') && ($newdesc) ) {
    $description = $newdesc;
  }
  return $description;
}
add_filter( 'get_the_post_type_description', 'fhf_team_archive_description' );
