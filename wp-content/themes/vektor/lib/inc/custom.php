<?php
	
function is_localhost() {
	return ($_SERVER['HTTP_HOST'] == 'localhost');
}

function add_filters($tags, $function) {
	foreach($tags as $tag) {
		add_filter($tag, $function);
	}
}

function is_element_empty($element) {
	$element = trim($element);
	return empty($element) ? false : true;
}

function is_vektor_logged_in() {
	if(is_user_logged_in()) {
		
		$user_obj = wp_get_current_user();
		
		if($user_obj->user_login == 'vektorgrafik') {
			return true;
		}
		
		if(preg_match('/@vektorgrafik\.se/i', $user_obj->user_email)) {
			return true;
		}
	}
	
	return false;
}

function is_vektor_ip() {
	if(!empty($_SERVER['REMOTE_ADDR'])) {
		$ip_addresses = array('85.24.171.11');
		
		if(in_array($_SERVER['REMOTE_ADDR'], $ip_addresses))
			return true;
	}
	
	return false;
}

/*
 * Limit words of a string
 */

function limit_words($string, $word_limit) {
	return wp_trim_words($string, $word_limit);
}

/*
 * Limit characters of a string
 */

function limit_characters($string, $limit){
	$string = mb_substr($string, 0, $limit, 'UTF-8');
	
	if(strlen($string) > $limit){
		return $string . "...";	
	} else {
		return $string;
	}
}

/*
 * Get custom taxonomies
 */

function get_custom_tax($tax){
	global $post;
	$terms = get_the_terms($post->ID, $tax);
	if($terms){
		$out = array();
		foreach($terms as $term){
			$out[] = $term->name;
		}
		$out = implode($out, ', ');
		return $out;
	} else {
		return null;
	}
}

/*
 * wp_list_categories with a twist
 */
 
function wp_list_modulus_categories($taxonomy, $modulus = 4, $get_terms_options = array()) {
	$current_queried_id = -1;
	if(is_tax('custom_cat')) // Ändra det här till din taxonomi
		$current_queried_id = get_queried_object_id();
	
	$modulus = absint($modulus);
	
	$defaults = array(
		'hide_empty' => FALSE,
		'parent' => 0
	);
	$options = wp_parse_args($get_terms_options, $defaults);
	
	$terms = get_terms($taxonomy, $options);
	
	$i = 1;
	foreach($terms as $term) {
	?>
		<li class="cat-item cat-item-<?php echo $term->term_id; ?><?php if($current_queried_id == $term->term_id) echo ' current-cat'; ?>"><a href="<?php echo get_term_link($term); ?>" title="<?php echo esc_attr(sprintf(__( 'View all posts filed under %s'), $term->name)); ?>"><?php echo esc_attr($term->name); ?></a></li>
	<?php
		if($i % $modulus == 0) {
		?>
			</ul>
			<ul class="clearfix">
		<?php
		}
		$i++;
	}
}

if(!function_exists('pr')) :
/*
 * Debug funktion för att enkelt skriva ut variabler i en <pre>.
 */
function pr() {
	
	if(func_num_args() < 1) {
		return;
	}
	
	echo '<pre>';
	
	foreach(func_get_args() as $value) {
			
		if(is_scalar($value) || empty($value)) {
			var_dump($value);
		} else {
			print_r($value);
		}
		
	}
	
	echo '</pre>';
}

endif;

if(!function_exists('get_page_by_template')) :
/*
 * Hämta en eller flera sidor med en viss template.
 * Per default hämtar den bara den första, annars skickar du in -1 i $limit.
 */
function get_page_by_template($template, $limit = 1) {
	if(empty($template))
		return false;
	
	$pages = get_posts(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => $template,
		'limit' => $limit
	));
	
	if(!empty($pages)) {
		$pages = array_slice($pages, 0, $limit);
		
		if($limit == 1)
			$pages = $pages[0];
	}
	
	return $pages;
}

endif;

/*
 * Skapa en egen inställningssida med ACF Option field
 * http://www.advancedcustomfields.com/resources/acf_add_options_sub_page/
 */

/*
function vektor_register_option_sub_pages(){
	if(function_exists('acf_add_options_sub_page')):
		acf_add_options_sub_page(array(
			'title' => __('Custom Settings Page', 'vektor'),
			'parent' => 'options-general.php',
			'capability' => 'manage_options'
		));
	endif;
}
add_action( 'init', 'vektor_register_option_sub_pages');
*/

/*
 * Video wrapper for responsive videos
 */

function vektor_video_wrapper($content) {
    // match any iframes
    $pattern = '~<iframe.*</iframe>|<embed.*</embed>|<object.*</object>~';
    preg_match_all($pattern, $content, $matches);

    foreach ($matches[0] as $match) {
        // wrap matched iframe with div
        $wrappedframe = '<div class="video-container">' . $match . '</div>';

        //replace original iframe with new in content
        $content = str_replace($match, $wrappedframe, $content);
    }

    return $content;    
}
add_filter('the_content', 'vektor_video_wrapper');


/*
 *  Posts 2 posts
 */

function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'cases_to_services',
        'from' => 'case',
        'to' => 'service'
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );

/*
 * Get nav menu title
 */
function wp_nav_menu_title($theme_location) {
    $title = '';
    if($theme_location && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])){
        $menu = wp_get_nav_menu_object($locations[$theme_location]);
        if($menu && $menu->name){
            $title = $menu->name;
        }
    }
    return apply_filters('wp_nav_menu_title', $title, $theme_location);
}

add_action( "wp_ajax_load_more", "load_more_func" ); // when logged in
add_action( "wp_ajax_nopriv_load_more", "load_more_func" );//when logged out

function load_more_func() {
    $offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
    $posts_per_page = isset($_REQUEST['posts_per_page'])?intval($_REQUEST['posts_per_page']):6;

    ob_start(); // buffer output instead of echoing it

    $args = array(
        'offset' => $offset,
        'posts_per_page' => $posts_per_page + 1
    );

    $posts_query = new WP_Query($args);

    if ($posts_query->have_posts()) {

        $result['have_posts'] = true;
        $dont_show = $posts_per_page + 1;

        //are there more posts?
        if($posts_query->post_count >= $dont_show) {
            $result['have_posts_next'] = true;
        } else {
            $result['have_posts_next'] = false;
        }
        $count = 0;

        while ( $posts_query->have_posts() ) : $posts_query->the_post(); $count++; ?>
            <?php if($count < $dont_show): ?>
            
            	<?php get_template_part('templates/news-article'); ?>
            
            <?php endif; ?>
        <?php endwhile;
        $result['html'] = ob_get_clean();

    } else {
        //no posts found
        $result['have_posts'] = false;
    }
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result); // encode result array into json feed
        echo $result; // by echo we return JSON feed on POST request sent via AJAX
    }
    else {
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
    die();
}

