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

// add support for excerpt for features
add_post_type_support( 'feature', 'excerpt' );


/**
* Add REST API support to the Team Member category.
*/
function finkom_feature_category_rest_support() {
  global $wp_taxonomies;

  //be sure to set this to the name of your taxonomy!
  $taxonomy_name = 'feature-category';

  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;

  }
}

add_action( 'init', 'finkom_feature_category_rest_support', 25 );


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

if ( ! function_exists( 'finkom_feature_terms' ) ) :
function finkom_feature_terms () {
  global $post;
  	/**
  	* Prints HTML with meta information for the project categories and project tags.
  	*/
  		// Hide category and tag text for pages.
  		if ( 'feature' === get_post_type() ) {
  			/* translators: used between list items, there is a space after the comma */
  			$categories_list = get_the_term_list( $post->ID, 'feature-category', '<span class="label">' . esc_html__( 'Categories', 'finkom_helper_functions') . ': </span>', esc_html__( ', ', 'list item separator', 'finkom_helper_functions' ) );
  			if ( $categories_list ) {
  				/* translators: 1: list of categories. */
  				printf( '<div class="cat-links">' . esc_html__( '%1$s', 'finkom_helper_functions' ) . '</div>', $categories_list ); // WPCS: XSS OK.
  			}
  		}

}
endif;
?>
