<?php

add_action('user_register', 'vektor_user_register', 10, 1);
add_action('after_setup_theme', 'vektor_add_acf_options_page', 11);

function vektor_user_register($user_id) {
	update_user_meta($user_id, 'show_welcome_panel', 0);
	update_user_meta($user_id, 'show_admin_bar_front', 'false');
}

function vektor_add_acf_options_page() {
	if(function_exists('acf_add_options_sub_page')) {
		acf_add_options_sub_page(array(
			'title' => __('Other settings', 'vektor'),
			'parent' => 'options-general.php',
		));
	}
}

/*
 * Login styles
 */

function vektor_login_styles() {
	echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/lib/css/login.css">';
}

add_action('login_head', 'vektor_login_styles');

/*
 * Login scripts
 */

function vektor_login_scripts() {
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/lib/js/modernizr.min.js', false, null, false );
}

add_action( 'login_enqueue_scripts', 'vektor_login_scripts' );

/*
 * Login url
 */

function vektor_login_url() {
	return home_url();
}

add_filter('login_headerurl', 'vektor_login_url');

/*
 * Login title
 */

function vektor_login_title() {
	return get_option('blogname');
}

add_filter('login_headertitle', 'vektor_login_title');

/*
 * Admin footer
 */

function vektor_vektor_admin_footer() {
	echo '<span id="footer-thankyou"><a href="http://www.vektorgrafik.se" target="_blank">' . __('Web agency', 'vektor') . ' Vektorgrafik</a></span>';
}

add_filter('admin_footer_text', 'vektor_vektor_admin_footer');