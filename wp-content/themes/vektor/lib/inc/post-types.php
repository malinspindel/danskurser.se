<?php

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'vektor_flush_rewrite_rules' );

// Flush your rewrite rules
function vektor_flush_rewrite_rules() {
	flush_rewrite_rules();
}

function vektor_post_types() { 
	
	register_post_type( 'service', array(
		'labels' => array(
			'name' => __( 'Services', 'vektor' ),
			'singular_name' => __( 'Service', 'vektor' ),
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_icon' => false,
		'rewrite'	=> array( 'slug' => __('service', 'vektor'), 'with_front' => false ),
		'has_archive' => false,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'thumbnail')
	) );

	register_post_type( 'case', array(
		'labels' => array(
			'name' => __( 'Cases', 'vektor' ),
			'singular_name' => __( 'Case', 'vektor' ),
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_icon' => false,
		'rewrite'	=> array( 'slug' => __('case', 'vektor'), 'with_front' => false ),
		'has_archive' => false,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'thumbnail')
	) );

	register_post_type( 'employee', array(
		'labels' => array(
			'name' => __( 'Employees', 'vektor' ),
			'singular_name' => __( 'Employee', 'vektor' ),
		),
		'public' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'menu_icon' => false,
		'rewrite'	=> array( 'slug' => __('employee', 'vektor'), 'with_front' => false ),
		'has_archive' => false,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'thumbnail')
	) );

	register_post_type( 'slideshow', array(
		'labels' => array(
			'name' => __( 'Slideshows', 'vektor' ),
			'singular_name' => __( 'Slideshow', 'vektor' ),
		),
		'public' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'menu_icon' => false,
		'rewrite'	=> array( 'slug' => __('slideshow', 'vektor'), 'with_front' => false ),
		'has_archive' => false,
		'hierarchical' => true,
		'supports' => array( 'title')
	) );
	
	register_taxonomy( 'case_cat', array('case'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => __( 'Categories', 'vektor' ),
			'singular_name' => __( 'Category', 'vektor' ),
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'category' ),
	) );
}

add_action( 'init', 'vektor_post_types');