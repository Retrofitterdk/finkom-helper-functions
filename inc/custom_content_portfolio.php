<?php

/**
 * Change name of Custom Content Portfolio post type.
 */
function finkom_ccp_portfolio_posttype($portfolio_posttype) {
	$portfolio_posttype = _x( 'project', 'portfolio posttype', 'finkom_helper_functions' );

	return $portfolio_posttype;
}

add_filter('ccp_get_project_post_type', 'finkom_ccp_portfolio_posttype');

/**
 * Add REST API support to the Custom Content Portfolio post type.
 */
add_action( 'init', 'finkom_ccp_rest_support', 25 );
function finkom_ccp_rest_support() {
  global $wp_post_types;

  //be sure to set this to the name of your post type!
  $post_type_name = 'project';
  if( isset( $wp_post_types[ $post_type_name ] ) ) {
    $wp_post_types[$post_type_name]->show_in_rest = true;
  }
}

/**
 * Change name of Custom Content Portfolio category.
 */
function finkom_ccp_category_name($category_name) {
	$category_name = _x( 'project_category', 'category name', 'finkom_helper_functions' );

	return $category_name;
}

add_filter('ccp_get_category_taxonomy', 'finkom_ccp_category_name');

/**
 * Add REST API support to the Custom Content Portfolio category.
 */
add_action( 'init', 'finkom_ccp_category_rest_support', 25 );
function finkom_ccp_category_rest_support() {
  global $wp_taxonomies;

  //be sure to set this to the name of your taxonomy!
  $taxonomy_name = 'project_category';

  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;

  }
}

/**
 * Change name of Custom Content Portfolio tags.
 */
function finkom_ccp_tag_name($tag_name) {
	$tag_name = _x( 'project_tag', 'tag name', 'finkom_helper_functions' );

	return $tag_name;
}

add_filter('ccp_get_tag_taxonomy', 'finkom_ccp_tag_name');

/**
 * Add REST API support to the Custom Content Portfolio category.
 */
add_action( 'init', 'finkom_ccp_tag_rest_support', 25 );
function finkom_ccp_tag_rest_support() {
  global $wp_taxonomies;

  //be sure to set this to the name of your taxonomy!
  $taxonomy_name = 'project_tag';

  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;

  }
}

?>
