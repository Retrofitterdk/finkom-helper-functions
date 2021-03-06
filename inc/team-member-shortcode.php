<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function finkom_member_shortcode_template( $query_args, $attr ) {

  $query_args['post_type'] = 'team-member';

  $loop = new WP_Query( $query_args );

  $html = '';
  $content = '';
  $html .= $attr['before'] . "\n";
  if ( '' != $attr['title'] ) {
    $html .= '<header class="widget-header recent-member-header">';
    $html .= $attr['before_title'] . esc_html( $attr['title'] ) . $attr['after_title'] . "\n";
    if ( '' != $attr['description'] ) {
      $html .= $attr['before_description'] . esc_html( $attr['description'] ) . $attr['after_description'] . "\n";
    }
    $html .= '</header>';
  }
  $col = esc_attr( intval( $attr['col'] ) );
  $layout = '';
  if ($col > 1) {
    $layout = ' is-grid';
  }
  $html .= '<div class="widget-content member-content' . $layout . ' columns-' . $col . '">' . "\n";



  while ( $loop->have_posts() ) :
    global $post;
    $loop->the_post();
    $content .= '<article id="post-' . get_the_ID() . '" class="team-member">';
    $content .= '<div class="entry-media"><a class="post-thumbnail" href="' . get_the_permalink() . '" aria-hidden="true">';
    $content .= get_the_post_thumbnail( $post->ID, $attr['size'], array('alt' => the_title_attribute( array('echo' => false))));
    $content .= '</a></div>';
    $content .= '<header class="entry-header"><a href="' . get_the_permalink() . '" title="' . the_title_attribute( array('echo' => false)) . '"><h3 class="entry-title">' . get_the_title() . '</h3></a></header>';
    $content .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div>';
    $content .= '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( array('echo' => false)) . '"><p class="entry-link">' . __( 'Continue reading', 'finkom_helper_functions' ) . '</p></a>';
    $content .= '</article>';

  endwhile;
  $html .= $content;
  $html .= '</div><!--/.projects-contents-->' . "\n";
  $html .= $attr['after'] . "\n";
  wp_reset_postdata();

  return $html;
}

function finkom_members_shortcode( $attr = array() ) {

  // All plugin/theme devs to short-ciruit the default output and roll their own.
  $out = apply_filters( 'finkom_members_shortcode', '', $attr );

  if ( $out )
  return $out;

  $defaults = array(
    'limit'    => 4,
    'order'    => 'DESC',
    'orderby'  => 'date',
    'col'  => 2,
    'size' 				=> 'large',
    'before' 	 => '<section class="widget widget_recent widget_recent_members">',
    'after' 	 => '</section><!--/.widget widget_recent widget_recent_members-->',
    'title' 			=> fhf_team_get_title_setting(),
    'before_title' 		=> '<h2 class="widget-title">',
    'after_title' 		=> '</h2>',
    'description' 			=> fhf_team_get_description_setting(),
    'before_description' 		=> '<p>',
    'after_description' 		=> '</p>'

  );

  $attr = shortcode_atts( $defaults, $attr, 'finkom_members' );

  $query_args = array(
    'posts_per_page' => absint( $attr['limit'] ),
    'order'          => $attr['order'],
    'orderby'        => $attr['orderby'],
  );

  return finkom_member_shortcode_template( $query_args, $attr );
}

add_shortcode( 'finkom_members', 'finkom_members_shortcode' );
