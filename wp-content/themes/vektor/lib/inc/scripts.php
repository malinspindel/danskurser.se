<?php

/*
 * Enqueue scripts and styles
 */

function vektor_scripts() {

	/*
	 * Register styles
	 */

	wp_register_style( 'plugins', get_template_directory_uri() . '/lib/css/plugins.css', false, null, false );
	wp_register_style( 'style', get_template_directory_uri() . '/style.css', false, null, false );

	/*
	 * Enqueue styles
	 */

	wp_enqueue_style('plugins');
	wp_enqueue_style('style');

	/*
	 * Register scripts
	 */

	// Modernizr
	wp_register_script( 'modernizr', get_template_directory_uri() . '/lib/js/modernizr.min.js', false, null, false );

	// jQuery
	wp_deregister_script('jquery');
	wp_register_script( 'jquery', get_template_directory_uri() . '/lib/js/jquery.min.js', false, null, true );

	// Plugins
	wp_register_script( 'plugins', get_template_directory_uri() . '/lib/js/plugins.js', array('jquery'), null, true );
	
	// Google maps
	wp_register_script( 'googlemaps', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), null, true );


	/*
	 * Enqueue scripts
	 */

	wp_enqueue_script('modernizr');
	wp_enqueue_script('app');
	
}

add_action( 'wp_enqueue_scripts', 'vektor_scripts', 100 );

/*
 * IE Scripts
 */

function ie_scripts(){
	echo '<!--[if lt IE 9]>
	<script src="' . get_template_directory_uri() . '/lib/js/respond.min.js"></script>
	<![endif]-->';
}

add_action('wp_head', 'ie_scripts');

/*
 * Google Analytics
 */

function vektor_google_analytics() { ?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
</script>

<?php }
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
  add_action('wp_footer', 'vektor_google_analytics', 20);
}