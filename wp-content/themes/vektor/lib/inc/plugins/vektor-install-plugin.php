<?php

define('VEKTOR_PLUGIN_EXTRACT_TO', WP_PLUGIN_DIR);

class Vektor_Install_Plugin {
	
	public static function install_plugins($plugins) {
		
		if(!is_array($plugins) || empty($plugins)) {
			return true;
		}
		
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		
		wp_filesystem();
		
		$errors = array();
		
		foreach($plugins as $main_plugin_file_path => $plugin_url) {
			
			wp_clean_plugins_cache();
			
			if(file_exists(trailingslashit(VEKTOR_PLUGIN_EXTRACT_TO) . $main_plugin_file_path)) {
				
				if(!is_plugin_active($main_plugin_file_path)) {
					
					$activated_plugin = activate_plugin($main_plugin_file_path, null, false, true);
					if(!is_null($activated_plugin)) {
						$errors[$main_plugin_file_path] = is_wp_error($activated_plugin) ? $activated_plugin->get_error_message() : 'Kunde inte aktivera plugin.';
					}
				}
				
				continue;
			}
			
			$zip_file = download_url($plugin_url, 20);
			if(is_wp_error($zip_file)) {
				$errors[$main_plugin_file_path] = $zip_file->get_error_message();
				continue;
			}
			
			$unzipped = unzip_file($zip_file, trailingslashit(VEKTOR_PLUGIN_EXTRACT_TO));
			if(is_wp_error($unzipped)) {
				$errors[$main_plugin_file_path] = $unzipped->get_error_message();
				unlink($zip_file);
				continue;
			}
			
			$activated_plugin = activate_plugin($main_plugin_file_path, null, false, true);
			if(!is_null($activated_plugin)) {
				
				$errors[$main_plugin_file_path] = is_wp_error($activated_plugin) ? $activated_plugin->get_error_message() : 'Kunde inte aktivera plugin.';
				unlink($zip_file);
				continue;
			}
			
			unlink($zip_file);
		}
		
		if(!empty($errors)) {
			return $errors;
		}
		
		return true;
	}
	
}
