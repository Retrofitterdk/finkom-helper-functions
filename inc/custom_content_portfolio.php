<?php
if ( ! defined( 'ABSPATH' ) ) exit;

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

function finkom_project_meta( $before = '', $after = '', $echo = true ) {
  if ( in_the_loop() && ccp_is_single_project() && ccp_is_project() && ! post_password_required() ) {

    $project_meta = '';
    $project_meta .= ccp_get_project_client(     array( 'text' => esc_html__( 'Client: %s',    'finkom_helper_functions' ), 'wrap' => '<li %s>%s</li>' ) );
    $project_meta .= ccp_get_project_location(   array( 'text' => esc_html__( 'Location: %s',  'finkom_helper_functions' ), 'wrap' => '<li %s>%s</li>' ) );
    $project_meta .= ccp_get_project_start_date( array( 'text' => esc_html__( 'Started: %s',   'finkom_helper_functions' ), 'wrap' => '<li %s>%s</li>' ) );
    $project_meta .= ccp_get_project_end_date(   array( 'text' => esc_html__( 'Completed: %s', 'finkom_helper_functions' ), 'wrap' => '<li %s>%s</li>' ) );

    $project_metalink = '';
    $project_metalink .= ccp_get_project_link(       array( 'text' => esc_html__( 'Visit Project', 'finkom_helper_functions' ), 'before' => '<p>', 'after' => '</p>', 'wrap'    => '<a %s>%s</a>', ) );

    $project_metabox = '';
    if ( $project_meta || $project_metalink ) :
    $project_metabox .= '<div class="entry-meta">';
    if ( $project_meta ) :
      $project_metabox .= $before;
      $project_metabox .= $project_meta;
      $project_metabox .= $after;
    endif;
    $project_metabox .= $project_metalink;
    $project_metabox .= '</div>';
  endif;

    if ( $echo && $project_metabox )
    echo $project_metabox;
    else
    return $project_meta;
  }
}
if ( ! function_exists( 'finkom_project_terms' ) ) :
function finkom_project_terms () {

  	/**
  	* Prints HTML with meta information for the project categories and project tags.
  	*/
  		// Hide category and tag text for pages.
  		if ( 'project' === get_post_type() ) {
  			/* translators: used between list items, there is a space after the comma */
  			$categories_list = get_the_term_list( $post->ID, 'project_category', '<span class="label">' . esc_html__( 'Categories', 'finkom_helper_functions') . ': </span>', esc_html__( ', ', 'list item separator', 'finkom_helper_functions' ) );
  			if ( $categories_list ) {
  				/* translators: 1: list of categories. */
  				printf( '<div class="cat-links">' . esc_html__( '%1$s', 'finkom_helper_functions' ) . '</div>', $categories_list ); // WPCS: XSS OK.
  			}

  			/* translators: used between list items, there is a space after the comma */
  			$tags_list = get_the_term_list( $post->ID, 'project_tag', '<span class="label">' . esc_html__( 'Tags', 'finkom_helper_functions') . ': </span>', esc_html__( ', ', 'list item separator', 'finkom_helper_functions' ) );
  			if ( $tags_list ) {
  				/* translators: 1: list of tags. */
  				printf( '<div class="tags-links">' . esc_html__( '%1$s', 'finkom_helper_functions' ) . '</div>', $tags_list ); // WPCS: XSS OK.
  			}
  		}

}
endif;
?>
