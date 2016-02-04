<?php

if(!is_admin() || get_current_user_id() !== 1)
	return;

if(!class_exists('Vektor_Lang')) :

class Vektor_Lang {
	
	function __construct() {
		add_action('wp_dashboard_setup', array($this, 'wp_dashboard_setup'));
		add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
		add_action('wp_ajax_vl-generate-mo-file', array($this, 'generate_mo_file'));
	}
	
	function wp_dashboard_setup() {
		wp_add_dashboard_widget('vektor-lang', __('Generate .mo-file', 'vektor'), array($this, 'widget_html'));
	}
	
	function widget_html() {
		?>
		<p>
			<button id="vl-generate-mo-file" class="button button-secondary"><?php _e('Generate .mo-file', 'vektor'); ?></button>
			<span class="spinner" style="float: none;"></span>
		</p>
		<div id="vl-generate-result"></div>
		
		<?php
	}
	
	function admin_enqueue_scripts($hook) {
		if($hook !== 'index.php')
			return;
		
		wp_register_script('vl', vektor_dir('/lib/inc/plugins/vektor-lang.js'), 'jquery', '1.0', true);
		wp_enqueue_script('vl');
		
		wp_localize_script('vl', 'VektorLang', array('nonce' => wp_create_nonce('vl-generate-mo-file')));
	}
	
	function generate_mo_file() {
		check_ajax_referer('vl-generate-mo-file', 'nonce');
		
		require_once 'php-mo.php';
		
		$out = array();
		
		$po_files = glob(get_template_directory() . '/lang/*.po');
		//var_dump($po_files);
		
		if(!empty($po_files)) {
			foreach($po_files as $po_file) {
				$generate_res = @phpmo_convert($po_file);
				
				$mo_filename = str_replace('.po', '.mo', basename($po_file));
				
				$out[$mo_filename] = $generate_res;
				
				wp_send_json_success($out);
			}
		} else {
			$out = 'No .po files found.';
		}
		
		wp_send_json_error($out);
	}

}

new Vektor_Lang;

endif;

