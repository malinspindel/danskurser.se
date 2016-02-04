<?php

function vektor_export_filters() {
	?>
	<p><label><input type="radio" name="content" value="attachment" /> Media</label></p>
	<?php
}
add_action('export_filters', 'vektor_export_filters');

function vektor_add_rss2_namespace() {
	echo 'xmlns:media="http://search.yahoo.com/mrss/"';
}
add_filter('rss2_ns', 'vektor_add_rss2_namespace');

function vektor_add_featured_image_to_rss2() {
	global $post;
	
	if (has_post_thumbnail($post->ID)){
		$post_thumbnail_id = get_post_thumbnail_id($post->ID);
		$post_thumbnail = get_post($post_thumbnail_id);
		$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large');
		$post_thumbnail_small_src = wp_get_attachment_image_src($post_thumbnail_id);
		$post_thumbnail_mime_type = get_post_mime_type($post_thumbnail_id);
		?>
<media:content type="<?php echo $post_thumbnail_mime_type; ?>" width="<?php echo $post_thumbnail_src[1]; ?>" height="<?php echo $post_thumbnail_src[2]; ?>" url="<?php echo $post_thumbnail_src[0]; ?>">
	<media:description type="plain"><![CDATA[<?php echo $post_thumbnail->post_title; ?>]]></media:description>
	<media:thumbnail url="<?php echo $post_thumbnail_small_src[0]; ?>" width="<?php echo $post_thumbnail_small_src[1]; ?>" height="<?php echo $post_thumbnail_small_src[2]; ?>" />
</media:content>
		<?php
	}
}
add_filter('rss2_item', 'vektor_add_featured_image_to_rss2');

function vektor_pagination_string() {
	global $wp_rewrite;
	$wp_rewrite->pagination_base = __('page', 'vektor');
}
add_action('init', 'vektor_pagination_string');

function vektor_sanitize_file_name($filename) {
	$filename = str_replace(array('å', 'ä', 'Å', 'Ä'), 'a', $filename);
	$filename = str_replace(array('ö', 'Ö'), 'o', $filename);
	
	$filename = preg_replace('/[^a-zA-Z0-9\_\-\.]+/i', '', $filename);
	
	$filename = mb_strtolower($filename);
	
	return $filename;
}
add_filter('sanitize_file_name', 'vektor_sanitize_file_name', 10, 1);

/*
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
function vektor_head_cleanup() {
  // Originally from http://wpengineer.com/1438/wordpress-header/
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );

  global $wp_widget_factory;
  if(isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
	  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }

  if (!class_exists('WPSEO_Frontend')) {
	remove_action('wp_head', 'rel_canonical');
	add_action('wp_head', 'vektor_rel_canonical');
  }
}

/*
 * Hide certain items in admin bar
 */

function vektor_custom_admin_bar(){
  global $wp_admin_bar;
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('updates');
	//$wp_admin_bar->remove_node('new-post');
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('wpseo-menu');
	$wp_admin_bar->remove_node('delete-cache');
}

add_action( 'wp_before_admin_bar_render' , 'vektor_custom_admin_bar' );

/*
 * Hide adminbar
 */

//add_filter( 'show_admin_bar', '__return_false' );


/*
 * Remove certain menu pages
 */

function vektor_remove_menu_pages(){
	global $current_user;
	
	//remove_menu_page('edit.php');
	remove_menu_page('link-manager.php');
	remove_menu_page('edit-comments.php');
  
  if(!is_vektor_logged_in()) {
	remove_menu_page('themes.php');
  }
	
	add_submenu_page('edit.php?post_type=page', __('Menus'), __('Menus'), 'manage_options', 'nav-menus.php');
	add_submenu_page('edit.php?post_type=page', __('Widgets'), __('Widgets'), 'manage_options', 'widgets.php');
	
	get_currentuserinfo();
	
	if($current_user->ID != 1 && strtolower($current_user->user_login) != 'vektorgrafik') {
		remove_menu_page('edit.php?post_type=acf');
		remove_menu_page('edit.php?post_type=acf-field-group');
	}
}

add_action( 'admin_menu', 'vektor_remove_menu_pages' );

function vektor_rel_canonical() {
  global $wp_the_query;

  if (!is_singular()) {
	return;
  }

  if (!$id = $wp_the_query->get_queried_object_id()) {
	return;
  }

  $link = get_permalink($id);
  echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}

add_action('init', 'vektor_head_cleanup');

/*
 * Remove the WordPress version from RSS feeds
 */

add_filter('the_generator', '__return_false');

/*
 * Clean up language_attributes() used in <html> tag
 *
 * Change lang="en-US" to lang="en"
 * Remove dir="ltr"
 */

function vektor_language_attributes() {
  $attributes = array();
  $output = '';

  if (function_exists('is_rtl')) {
	if (is_rtl() == 'rtl') {
	  $attributes[] = 'dir="rtl"';
	}
  }

  $lang = get_bloginfo('language');

  if ($lang && $lang !== 'en-US') {
	$attributes[] = "lang=\"$lang\"";
  } else {
	$attributes[] = 'lang="en"';
  }

  $output = implode(' ', $attributes);
  $output = apply_filters('vektor_language_attributes', $output);

  return $output;
}

add_filter('language_attributes', 'vektor_language_attributes');

/*
 * Manage output of wp_title()
 */

function vektor_wp_title($title) {
  if (is_feed()) {
	return $title;
  }

  $title .= get_bloginfo('name');
  if(is_front_page() && get_bloginfo('description')) $title .= " - " . get_bloginfo('description');

  return $title;
}

add_filter('wp_title', 'vektor_wp_title', 10);

/*
 * Clean up output of stylesheet <link> tags
 */

function vektor_clean_style_tag($input) {
  preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
  // Only display media if it is meaningful
  $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
  return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

add_filter('style_loader_tag', 'vektor_clean_style_tag');

/*
 * Add and remove body_class() classes
 */

function vektor_body_class($classes) {
  // Add post/page slug
  if (is_single() || is_page() && !is_front_page()) {
	$classes[] = "page-" . basename(get_permalink());
  }

  // Remove unnecessary classes
  $home_id_class = 'page-id-' . get_option('page_on_front');
  $remove_classes = array(
	'page-template-default',
	$home_id_class
  );
  $classes = array_diff($classes, $remove_classes);

  return $classes;
}

add_filter('body_class', 'vektor_body_class');

/*
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */

function vektor_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  return '<div class="entry-content-asset">' . $cache . '</div>';
}

add_filter('embed_oembed_html', 'vektor_embed_wrap', 10, 4);

/*
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */

function vektor_remove_dashboard_widgets() {
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
	remove_meta_box('dashboard_secondary', 'dashboard', 'side');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
}

add_action('admin_init', 'vektor_remove_dashboard_widgets');

/*
 * Clean up the_excerpt()
 */

function vektor_excerpt_length($length) {
	$excerpt = POST_EXCERPT_LENGTH;
	if(!empty($excerpt)){
		return $excerpt;
	} else {
		return 50;  
	}
}

function vektor_excerpt_more($more) {
  return '&hellip;';
}

add_filter('excerpt_length', 'vektor_excerpt_length');
add_filter('excerpt_more', 'vektor_excerpt_more');

/*
 * Remove unnecessary self-closing tags
 */

function vektor_remove_self_closing_tags($input) {
  return str_replace(' />', '>', $input);
}

add_filter('get_avatar',		  'vektor_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',	  'vektor_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'vektor_remove_self_closing_tags'); // <img />

/*
 * Don't return the default description in the RSS feed if it hasn't been changed
 */

function vektor_remove_default_description($bloginfo) {
  $default_tagline = 'Just another WordPress site';
  return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}
add_filter('get_bloginfo_rss', 'vektor_remove_default_description');

/*
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */

function vektor_nice_search_redirect() {
  global $wp_rewrite;
  if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
	return;
  }

  $search_base = $wp_rewrite->search_base;
  if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
	wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
	exit();
  }
}
if (current_theme_supports('nice-search')) {
  add_action('template_redirect', 'vektor_nice_search_redirect');
}

/*
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */

function vektor_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s'])) {
	$query_vars['s'] = ' ';
  }

  return $query_vars;
}
add_filter('request', 'vektor_request_filter');

/*
 * Tiny mce buttons
 */

function vektor_mce_buttons_2($buttons){
	array_unshift($buttons, 'hr, styleselect');
	return $buttons;
}

add_filter('mce_buttons_2', 'vektor_mce_buttons_2');

function vektor_tiny_mce_before_init($settings){
	$settings['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5';

	$style_formats = array(
		array('title' => 'Ingress', 'inline' => 'span', 'classes' => 'intro')
	);

	$settings['style_formats'] = json_encode($style_formats);
	return $settings;
}

add_filter('tiny_mce_before_init', 'vektor_tiny_mce_before_init');