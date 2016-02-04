<?php

if(!class_exists('Vektor_Menu')) :

class Vektor_Menu {
	
	private $output = FALSE;
	
	function __construct($options = array()) {
		global $post;
		
		$options = wp_parse_args($options, array(
			'post'				=> false,
			'exclude'			=> array(),
			'orderby'			=> 'menu_order, post_title',
			'order'				=> 'ASC',
			'show_on_cpt'		=> true,
			'title_in_list'		=> false,
			'title'				=> true,
			'link_title'		=> true,
			'title_before_tag'	=> '<span class="h6 nav-title">',
			'title_after_tag'	=> '</span>',
			'post_type'			=> false
		));
		
		if($options['post']) {
			$post = get_post($options['post']);
		}
		
		if(is_home()) {
			if($posts_page = get_option('page_for_posts'))
				$post = get_page($posts_page);
			else
				return FALSE;
		}
		
		if(empty($options['post_type']))
			$options['post_type'] = $post->post_type;
		
		$exclude_list = wp_parse_args($options['exclude']);
		
		if(is_search() || is_404())
			return FALSE;
		
		$post_type = get_post_type_object($options['post_type']);
		
		if(empty($post_type))
			return FALSE;
		
		$is_cpt = !$post_type->_builtin;
		if(!$post_type->hierarchical) {
			$this->output = 'Post type needs to be hierarchical.';
			return FALSE;
		}
		
		if(is_array($options['show_on_cpt'])) {
			if(!in_array($options['post_type'], $options['show_on_cpt']))
				return FALSE;
		} else if(!$options['show_on_cpt']) {
			if($is_cpt)
				return FALSE;
		}
		
		$post_ancestors = get_post_ancestors($post->ID);
		$top_page = $post_ancestors ? end($post_ancestors) : $post->ID;
		
		$always_excluded = array_merge($post_ancestors, array($post->ID));
		
		$depth = count($post_ancestors) + 1;
		
		if($is_cpt) {
			
			$top_page = 0; // Since a CPT doesnt have a top ancestor like pages we have to set this to 0 to get all the posts with parent 0.
			$depth = 0;
			
			$post_siblings = get_pages(array(
				'parent' => 0,
				'exclude' => implode(',', $always_excluded),
				'post_type' => $options['post_type'],
			));
			foreach($post_siblings as $post_sibling) {
				$excludes = get_pages(array(
					'child_of' => $post_sibling->ID,
					'post_type' => $options['post_type']
				));
				foreach($excludes as $exclude)
					$exclude_list[] = $exclude->ID;
			}
			
		} else {
			
			foreach($post_ancestors as $post_ancestor) {
				$pages = get_pages(array(
					'child_of'	=> $post_ancestor,
					'parent'	=> $post_ancestor,
					'exclude'	=> implode(',', $always_excluded),
					'post_type'	=> $options['post_type']
				));
				
				foreach($pages as $page) {
					$excludes = get_pages(array(
						'child_of'	=> $page->ID,
						'parent'	=> $page->ID,
						'post_type'	=> $options['post_type']
					));
					foreach($excludes as $exclude) {
						$exclude_list[] = $exclude->ID;
					}
				}
			}
			
		}
		
		$list_pages_args = array(
			'title_li'		=> '',
			'echo'			=> 0,
			'child_of'		=> $top_page,
			'exclude'		=> implode(',', $exclude_list),
			'depth'			=> $depth,
			'sort_column'	=> $options['orderby'],
			'sort_order'	=> $options['order'],
			'post_type'		=> $options['post_type']
		);
		
		$children = wp_list_pages($list_pages_args);
		
		if(!$children)
			return FALSE;
			
		if($options['title_in_list']) {
			
			$title = wp_list_pages(array(
				'title_li'	=> '',
				'echo'		=> 0,
				'include'	=> $top_page
			));
			$children = $title . $children;
			
		} else if($options['title']) {
			
			$title = is_string($options['title']) ? apply_filters('the_title', $options['title']) : apply_filters('the_title', get_the_title($top_page));
			$this->output .= $options['title_before_tag'];
			
			if($options['link_title'])
				$this->output .= sprintf('<a href="%s">%s</a>', is_string($options['link_title']) ? esc_attr($options['link_title']) : get_permalink($top_page), $title);
			else
				$this->output .= $title;
			
			$this->output .= $options['title_after_tag']. "\n";
			
		}
		
		$this->output .= "<ul>\n";
		$this->output .= "\t" . $children . "\n";
		$this->output .= "</ul>\n";
		
		wp_reset_postdata();
	}
	
	function output() {
		return $this->output;
	}
}

if(!function_exists('vektor_menu')) :

function the_vektor_menu($options = array()) {
	$vektor_menu = new Vektor_Menu($options);
	echo $vektor_menu->output();
}

function get_the_vektor_menu($options = array()) {
	$vektor_menu = new Vektor_Menu($options);
	return $vektor_menu->output();
}

endif;

endif;

