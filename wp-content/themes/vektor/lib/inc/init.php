<?php

/*
 * Vektor initial setup and constants
 */
 
function vektor_setup() {
  // Make theme available for translation
  load_theme_textdomain('vektor', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'vektor'),
		'top_navigation' => __('Top Navigation', 'vektor'),
    'footer_navigation' => __('Footer Navigation', 'vektor'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  add_image_size('square-small', 240, 240, true);
  
  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/lib/css/editor.css');
}

add_action('after_setup_theme', 'vektor_setup');

/*
 * Get theme directory
 */

function vektor_dir($path = ''){
  return get_template_directory_uri() . '/' . ltrim($path, '/');
}

/*
 * Primary navigation
 */

function vektor_nav(){
  if (has_nav_menu('primary_navigation')){
    wp_nav_menu(array('theme_location' => 'primary_navigation', 'container' => false));
  }
}

/*
 * Top navigation
 */

function vektor_top_nav(){
  if (has_nav_menu('top_navigation')){
    wp_nav_menu(array('theme_location' => 'top_navigation', 'container' => false));
  }
}

/*
 * Footer navigation
 */

function vektor_footer_nav(){
  if (has_nav_menu('footer_navigation')){
    wp_nav_menu(array('theme_location' => 'footer_navigation', 'container' => false));
  }
}

/*
 * Page navigation
 */

function vektor_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
  return;

    echo paginate_links( array(
		'base' => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format' => '',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text' => '&larr;',
		'next_text' => '&rarr;',
		'type' => 'list',
		'end_size' => 3,
		'mid_size' => 3
    ) );

} /* end page navi */
