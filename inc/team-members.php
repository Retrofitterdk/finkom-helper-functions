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

// add support for excerpt for team members
add_post_type_support( 'team-member', 'excerpt' );

/**
* Add REST API support to the Team Member category.
*/
function finkom_team_member_category_rest_support() {
  global $wp_taxonomies;

  //be sure to set this to the name of your taxonomy!
  $taxonomy_name = 'team-member-category';

  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;

  }
}

add_action( 'init', 'finkom_team_member_category_rest_support', 25 );


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

// disable meta fields
add_filter( 'woothemes_our_team_member_role', '__return_false' );
add_filter( 'woothemes_our_team_member_user_search', '__return_false' );

function finkom_team_member_more_fields( $fields ) {
    $fields['linkedin'] = array(
        'name' => __( 'Linkedin', 'finkom_helper_functions' ),
        'description' => __( 'Enter the URL for this team member\'s Linkedin page (for example: https://www.linkedin.com/in/barackobama/).', 'finkom_helper_functions' ),
        'type' => 'text',
        'default' => '',
        'section' => 'info'
    );

    $fields['facebook'] = array(
        'name' => __( 'Facebook', 'finkom_helper_functions' ),
        'description' => __( 'Enter the URL for this team member\'s Facebook page (for example: https://da-dk.facebook.com/zuck/).', 'finkom_helper_functions' ),
        'type' => 'text',
        'default' => '',
        'section' => 'info'
    );

    $fields['instagram'] = array(
        'name' => __( 'Instagram', 'finkom_helper_functions' ),
        'description' => __( 'Enter the URL for this team member\'s Instagram page (for example: https://www.instagram.com/kimkardashian/).', 'finkom_helper_functions' ),
        'type' => 'text',
        'default' => '',
        'section' => 'info'
    );

    $fields['pinterest'] = array(
        'name' => __( 'Pinterest', 'finkom_helper_functions' ),
        'description' => __( 'Enter the URL for this team member\'s Pinterest page (for example: https://www.pinterest.dk/ohjoy/).', 'finkom_helper_functions' ),
        'type' => 'text',
        'default' => '',
        'section' => 'info'
    );


    return $fields;
}
add_filter( 'woothemes_our_team_member_fields', 'finkom_team_member_more_fields' );


if ( ! function_exists( 'finkom_team_member_terms' ) ) :
function finkom_team_member_terms () {
  global $post;
  	/**
  	* Prints HTML with meta information for the project categories and project tags.
  	*/
  		// Hide category and tag text for pages.
  		if ( 'team-member' === get_post_type() ) {
  			/* translators: used between list items, there is a space after the comma */
  			$categories_list = get_the_term_list( $post->ID, 'team-member-category', '<span class="label">' . esc_html__( 'Categories', 'finkom_helper_functions') . ': </span>', esc_html__( ', ', 'list item separator', 'finkom_helper_functions' ) );
  			if ( $categories_list ) {
  				/* translators: 1: list of categories. */
  				printf( '<div class="cat-links">' . esc_html__( '%1$s', 'finkom_helper_functions' ) . '</div>', $categories_list ); // WPCS: XSS OK.
  			}
  		}

}
endif;
