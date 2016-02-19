<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */
/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/
// Load any external files you have here
/*------------------------------------*\
	Theme Support
\*------------------------------------*/
if (!isset($content_width))
{
    $content_width = 900;
}
if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/
    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}
/*------------------------------------*\
	Functions
\*------------------------------------*/
// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="primary-menu">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}
// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
      // jQuery
      	wp_deregister_script('jquery');
      	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-12.0.0.min.js', false, null, true );
    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!
        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!
        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
        wp_register_script('app', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}
// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}
// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/stylesheets/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!
    wp_register_style('foundation', get_template_directory_uri() . '/stylesheets/foundation.css', array(), '1.0', 'all');
    wp_enqueue_style('foundation'); // Enqueue it!
    wp_register_style('main-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('main-style'); // Enqueue it!
}
// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}
// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}
// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}
// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}
// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}
// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}
// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}
// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}
// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}
// Remove Admin bar
function remove_admin_bar()
{
    return false;
}
// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}
// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}
// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }
/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/
// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.
// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]
/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/
// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'danskurs'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'danskurs');
    register_post_type('danskurser', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Danskurser', 'danskurser'), // Rename these to suit
            'singular_name' => __('Danskurs', 'danskurs'),
            'add_new' => __('Add New', 'danskurs'),
            'add_new_item' => __('Add New Danskurs', 'danskurs'),
            'edit' => __('Edit', 'danskurs'),
            'edit_item' => __('Edit Danskurser Custom Post', 'danskurs'),
            'new_item' => __('New Danskurser Post', 'danskurs'),
            'view' => __('View Danskurser Post', 'danskurs'),
            'view_item' => __('View Danskurser Post', 'danskurs'),
            'search_items' => __('Search Danskurser Custom Post', 'danskurs'),
            'not_found' => __('No Danskurser Posts found', 'danskurs'),
            'not_found_in_trash' => __('No Danskurser Custom Posts found in Trash', 'danskurs')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}
/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/
// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}
// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}
// course_search
function course_search_scripts() {
  wp_enqueue_script( 'course-search', get_stylesheet_directory_uri() . '/js/course-search.js', array(), '1.0.0', true );
  wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(jquery), '1.0.0', true );
  wp_localize_script( 'course-search', 'ajax_url', admin_url('admin-ajax.php') );
}

function course_search(){
  course_search_scripts();
  ob_start();
  ?>
  <div id="course-search" class="">

    <div class="section-city">
    <form action="" method="get">


      <label for="city"><i class="fa fa-compass"></i></label>
      <select id="city" name="city">
        <option value="stockholm">Stockholm</option>
        <option value="goteborg">Göteborg</option>
        <option value="malmo">Malmö</option>
      </select>
    </div>

    <div class="section-filter" id="open">
      <div class="section-filter-first row">
        <div class="section-day column small-12 medium-6 large-4">
          <label for="day"><span><i class="fa fa-calendar"></i></span> <h2>Dag</h2></label>
          <select id="day" name="day">
            <option value="day_mon">Måndag</option>
            <option value="day_tue">Tisdag</option>
            <option value="day_wed">Onsdag</option>
            <option value="day_thu">Torsdag</option>
            <option value="day_fri">Fredag</option>
            <option value="day_sat">Lördag</option>
            <option value="day_sun">Söndag</option>
          </select>
        </div>

        <div class="section-time column small-12 medium-6 large-4">
          <label for="time"><span><i class="fa fa-clock-o"></i></span><h2>Tid</h2></label>
          <select id="time" name="time">
            <option value="time_7">07.00-11.00</option>
            <option value="time_11">11.00-15.00</option>
            <option value="time_15">15.00-18.00</option>
            <option value="time_18">18.00-00.00</option>
          </select>
        </div>

        <div class="section-age column small-12 medium-6 large-4">
          <label for="age"><span><i class="fa fa-heart-o"></i></span><h2>Ålder</h2></label>
          <select id="age" name="age">
            <option value="age_1">1-3 år</option>
            <option value="age_4">4-6 år</option>
            <option value="age_7">7-9 år</option>
            <option value="age_10">10-12 år</option>
            <option value="age_13">13-15 år</option>
            <option value="age_16">16+</option>
            <option value="age_30">30+</option>
            <option value="age_50">50+</option>
          </select>
        </div>
          <button id="button-second-filter">FLER VAL</button>
      </div>  <!--//section-filter-first -->

      <div class="section-filter-second row" id="second-filter">

        <div class=" small-10 medium-4 large-4 columns">
          <label for="level"><span><i class="fa fa-star"></i></span><h2>Nivå</h2></label>
          <select id="level" name="level">
            <option value="0">Alla nivåer</option>
            <option value="1">Nybörjare</option>
            <option value="2">Nybörjare - Fortsättning</option>
            <option value="3">Fortsättning</option>
            <option value="4">Fortsättning - Medel</option>
            <option value="5">Medel</option>
            <option value="6">Medel - Avancerad</option>
            <option value="7">Avancerad</option>
            <option value="8">Professionell</option>
            <option value="9">Ingen nivå</option>
          </select>
        </div>

        <div class=" small-10 medium-8 large-8 columns styles">
          <label for="styles"><span><i class="fa fa-tags"></i></span><h2>Dansstilar</h2></label>

          <div class="small-12 medium-6 large-4 columns styles-column">
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="balett" id="balett" />     <label for="balett"><p class="checkbox-label">Balett</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="barndans" id="barndans" />             <label for="barndans"><p class="checkbox-label">Barndans</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="breaking" id="breaking" />             <label for="breaking"><p class="checkbox-label">Breaking</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="dansmix" id="dansmix" />               <label for="dansmix"><p class="checkbox-label">Dansmix</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="flamenco" id="flamenco"/>              <label for="flamenco"><p class="checkbox-label">Flamenco</p></label>
            </div>
          </div>

          <div class="small-12 medium-6 large-4 columns styles-column padding-left">
            <div class="style-holder">
            <input class="style" type="checkbox" name="style" value="improvisation" id="improvisation" />   <label for="improvisation"><p class="checkbox-label">Improvisation</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="jazzdans" id="jazzdans" />             <label for="jazzdans"><p class="checkbox-label">Jazzdans</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="latinska" id="latinska" />             <label for="latinska"><p class="checkbox-label">Latinska</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="modernnutida" id="modernnutida" />     <label for="modernnutida"><p class="checkbox-label">Modern&amp;Nutida</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="musikal" id="musikal"/>                <label for="musikal"><p class="checkbox-label">Musikal</p></label>
            </div>

          </div>

          <div class="small-12 medium-6 large-4 columns styles-column padding-left">

            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="pardans" id="pardans" />               <label for="pardans"><p class="checkbox-label">Pardans</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="pilates" id="pilates" />               <label for="pilates"><p class="checkbox-label">Pilates</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="streetdance" id="streetdance" />       <label for="streetdance"><p class="checkbox-label">Streetdance</p></label>
            </div>
            <div class="style-holder">
              <input class="style" type="checkbox" name="style" value="yoga" id="yoga" />                     <label for="yoga"><p class="checkbox-label">Yoga</p></label>
            </div>

          </div>
        </div>

      </div> <!--//section-filter-second-->

      <button type="submit" id="button-search"><i class="fa fa-search"></i><span id="search">SÖK</span></button>

    </form>
    </div>

    <section class="section-result" id="result">
      <h2>Dina Sökresultat</h2>
      <!--The response output-->
      <div class="row">
        <ul class="columns small-centered small-12 medium-10 large-10"></ul>
      </div>

    </section>


  </div>
  <?php return ob_get_clean();
}
add_shortcode( 'course_search', 'course_search');

add_action( 'wp_ajax_course_search', 'course_search_callback' );
add_action( 'wp_ajax_nopriv_course_search', 'course_search_callback' );

//Create an ajax callback
function course_search_callback() {
  //Parsing to json, doesn't work?
   header("Content-type: application/json");
    $city = 0;
    if(isset($_GET['city']))
      $city = sanitize_text_field($_GET['city']);
    $day = 0;
    if(isset($_GET['day']))
      $day = sanitize_text_field($_GET['day']);
    $time = 0;
    if(isset($_GET['time']))
      $time = sanitize_text_field($_GET['time']);
    $age = 0;
    if(isset($_GET['age']))
      $age = sanitize_text_field($_GET['age']);
    // $level = 0;
    // if(isset($_GET['level']))
    //   $level = sanitize_text_field($_GET['level']);
    // $level_1 = 0;
    // if(isset($_GET['level_1']))
    //   $level_1 = intval(sanitize_text_field($_GET['level_1']) );
    //
    // $level_2 = 0;
    // if(isset($_GET['level_2']))
    //   $level_2 = intval(sanitize_text_field($_GET['level_2']) );
    //
    // $level_3 = 0;
    // if(isset($_GET['level_3']))
    //   $level_3 = intval(sanitize_text_field($_GET['level_3']) );
    //
    // $level_4 = 0;
    // if(isset($_GET['level_4']))
    //   $level_4 = intval(sanitize_text_field($_GET['level_4']) );
    //
    // $level_5 = 0;
    // if(isset($_GET['level_5']))
    //   $level_5 = intval(sanitize_text_field($_GET['level_5']) );
    //
    // $level_6 = 0;
    // if(isset($_GET['level_6']))
    //   $level_6 = intval(sanitize_text_field($_GET['level_6']) );
  //json result
  $result =  array();
  //query
  $args = array(
    "post_type" => "danskurser",
    "post_per_page" => -1,
    "meta_key" => 'level',
    "orderby" => 'meta_value_num',
    "order" => "ASC"
  );
  $args['meta_query'][] = array(
    'key' => 'city',
    'value' => $city,
    'compare' => '='
  );
  $args['meta_query'][] = array(
    'key' => 'day',
    'value' => $day,
    'compare' => '='
  );
  $args['meta_query'][] = array(
    'key' => 'time',
    'value' => $time,
    'compare' => '='
  );
  $args['meta_query'][] = array(
    'key' => 'age',
    'value' => $age,
    'compare' => '='
  );
  //
  // $args['meta_query'][] = array(
  //   'key' => 'level',
  //   'value' => $level,
  //   'compare' => '='
  // );
  $course_query = new WP_Query( $args );
    while( $course_query->have_posts() ){
      $course_query->the_post();
      $result[] = array(
        'id' => get_the_ID(),
        'title' => get_the_title(),
        'permalink' => get_permalink(),
        'link' => get_field('link'),
        'city' => get_field('city'),
        'course_name' => get_field('course_name'),
        'day' => get_field('day'),
        'time' => get_field('time'),
        'age' => get_field('age'),
        'course_time' => get_field('course_time'),
        'school' => get_field('school'),
        'level' => get_field('level'),
        // 'level1' => get_field('level_1'),
        // 'level2' => get_field('level_2'),
        // 'level3' => get_field('level_3'),
        // 'level4' => get_field('level_4'),
        // 'level5' => get_field('level_5'),
        // 'level6' => get_field('level_6'),
        'logo' => get_field('logo'),
        'styles' => get_field('styles')
      );
    }
    //application/json didn't work so I took pretty print nd stri-replae and it looks fine now
      //Fix utf-8
    $finalResult = json_encode($result, JSON_PRETTY_PRINT);
    $finalResult = str_replace("\/","/",$finalResult);
    echo $finalResult;
    wp_die();
}
?>
