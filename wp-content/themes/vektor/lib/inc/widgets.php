<?php
/*
 * Register sidebars and widgets
 */
function vektor_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary', 'vektor'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', 'vektor'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
}
add_action('widgets_init', 'vektor_widgets_init');

function vektor_dashboard_setup() {
	wp_add_dashboard_widget('vektor_facebook_widget', 'Gilla Vektorgrafik på Facebook', 'vektor_facebook_widget');
}
add_action('wp_dashboard_setup', 'vektor_dashboard_setup');

function vektor_facebook_widget() {
	echo '<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/sv_SE/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script><div class="fb-like" data-href="http://www.facebook.com/Vektorgrafik" data-send="false" data-width="260" data-show-faces="true"></div>';
}