<?php

/*
 * Theme activation
 */

if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
	wp_redirect(admin_url('themes.php?page=theme_activation_options'));
	exit;
}

define('VEKTOR_ACF_PRO_LICENSE', 'b3JkZXJfaWQ9MzM2Nzl8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTA3LTA4IDEyOjM0OjU2');

function vektor_theme_activation_options_init() {
	register_setting(
		'vektor_activation_options',
		'vektor_theme_activation_options'
	);
}

add_action('admin_init', 'vektor_theme_activation_options_init');

function vektor_activation_options_page_capability($capability) {
	return 'edit_theme_options';
}

add_filter('option_page_capability_vektor_activation_options', 'vektor_activation_options_page_capability');

function vektor_get_simple_history_version() {
	
	$version = '2.0.19';
	
	$res = wp_remote_get('http://plugins.svn.wordpress.org/simple-history/trunk/readme.txt');
	if (is_wp_error($res)) {
		return $version;
	}
	
	$data = wp_remote_retrieve_body($res);
	
	preg_match('/Stable tag:\s?(\d+(?:\.\d+)+)\n/', $data, $m);
	return strlen(end($m)) ? end($m) : $version;
}

function vektor_theme_activation_options_add_page() {
	$vektor_activation_options = vektor_get_theme_activation_options();
	
	if (!$vektor_activation_options) {
		
		if(is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
			
			/*
			 * Autoinstallerar plugins
			 */
			locate_template('lib/inc/plugins/vektor-install-plugin.php', true);
			
			$plugins = array(
				'advanced-custom-fields-pro/acf.php' => 'http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9MzM2Nzl8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTA3LTA4IDEyOjM0OjU2',
				'wordpress-seo/wp-seo.php' => 'http://downloads.wordpress.org/plugin/wordpress-seo.latest-stable.zip',
				'simple-page-ordering/simple-page-ordering.php' => 'https://downloads.wordpress.org/plugin/simple-page-ordering.zip',
				'simple-history/index.php' => sprintf('https://downloads.wordpress.org/plugin/simple-history.%s.zip', vektor_get_simple_history_version()),
			);
			
			global $vektor_install_plugin_result;
			$vektor_install_plugin_result = Vektor_Install_Plugin::install_plugins($plugins);
			
			if(isset($vektor_install_plugin_result) && $vektor_install_plugin_result !== true) {
				
				function admin_notice() {
					global $vektor_install_plugin_result;
					?>
					<div class="error">
						<p><strong>Följande plugins kunde inte laddas ned, installeras eller aktiveras.</strong></p>
						<p>
							<?php foreach($vektor_install_plugin_result as $plugin => $error_message) : ?>
								<strong><?php echo $plugin; ?></strong>: <?php echo $error_message; ?>
							<?php endforeach; ?>
						</p>
					</div>
					<?php
				}
				
				add_action('admin_notices', 'admin_notice');
			}
			
			$save = array(
				'key'	=> VEKTOR_ACF_PRO_LICENSE,
				'url'	=> get_bloginfo('url')
			);
			
			$save = maybe_serialize($save);
			$save = base64_encode($save);
			
			update_option('acf_pro_license', $save);
			/*
			 * Slut
			 */
			
		}
		
		$theme_page = add_theme_page(
			__('Theme Activation', 'vektor'),
			__('Theme Activation', 'vektor'),
			'edit_theme_options',
			'theme_activation_options',
			'vektor_theme_activation_options_render_page'
		);
	} else {
		if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
			flush_rewrite_rules();
			wp_redirect(admin_url('themes.php'));
			exit;
		}
	}
}

add_action('admin_menu', 'vektor_theme_activation_options_add_page', 50);

function vektor_get_theme_activation_options() {
	return get_option('vektor_theme_activation_options');
}

function vektor_theme_activation_options_render_page() {
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		
		<h2><?php printf(__('%s Theme Activation', 'vektor'), wp_get_theme()); ?></h2>
		
		<?php settings_errors(); ?>
		
		<form method="post" action="options.php">
			
			<?php settings_fields('vektor_activation_options'); ?>
			
			<table class="form-table">
			
				<tr valign="top"><th scope="row"><?php _e('Create static front page?', 'vektor'); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e('Create static front page?', 'vektor'); ?></span></legend>
							<select name="vektor_theme_activation_options[create_front_page]" id="create_front_page">
								<option selected="selected" value="true"><?php echo _e('Yes', 'vektor'); ?></option>
								<option value="false"><?php echo _e('No', 'vektor'); ?></option>
							</select>
							<br>
							<small class="description"><?php printf(__('Create a page called Home and set it to be the static front page', 'vektor')); ?></small>
						</fieldset>
					</td>
				</tr>
				
				<tr valign="top"><th scope="row"><?php _e('Change permalink structure?', 'vektor'); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e('Update permalink structure?', 'vektor'); ?></span></legend>
							<select name="vektor_theme_activation_options[change_permalink_structure]" id="change_permalink_structure">
								<option selected="selected" value="true"><?php echo _e('Yes', 'vektor'); ?></option>
								<option value="false"><?php echo _e('No', 'vektor'); ?></option>
							</select>
							<br>
						<small class="description"><?php printf(__('Change permalink structure to /&#37;category&#37;/&#37;postname&#37;/', 'vektor')); ?></small>
						</fieldset>
					</td>
				</tr>
				
				<tr valign="top"><th scope="row"><?php _e('Create navigation menu?', 'vektor'); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e('Create navigation menu?', 'vektor'); ?></span></legend>
							<select name="vektor_theme_activation_options[create_navigation_menus]" id="create_navigation_menus">
								<option selected="selected" value="true"><?php echo _e('Yes', 'vektor'); ?></option>
								<option value="false"><?php echo _e('No', 'vektor'); ?></option>
							</select>
							<br>
							<small class="description"><?php printf(__('Create the Primary Navigation menu and set the location', 'vektor')); ?></small>
						</fieldset>
					</td>
				</tr>
				
				<tr valign="top"><th scope="row"><?php _e('Add pages to menu?', 'vektor'); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e('Add pages to menu?', 'vektor'); ?></span></legend>
							<select name="vektor_theme_activation_options[add_pages_to_primary_navigation]" id="add_pages_to_primary_navigation">
								<option selected="selected" value="true"><?php echo _e('Yes', 'vektor'); ?></option>
								<option value="false"><?php echo _e('No', 'vektor'); ?></option>
							</select>
							<br>
							<small class="description"><?php printf(__('Add all current published pages to the Primary Navigation', 'vektor')); ?></small>
						</fieldset>
					</td>
				</tr>
			
			</table>
			
			<?php submit_button(); ?>
			
		</form>
	</div>

<?php
}

function vektor_theme_activation_action() {
	global $wp_registered_sidebars, $wp_filesystem;
	
	$vektor_theme_activation_options = vektor_get_theme_activation_options();
	
	if (!$vektor_theme_activation_options) {
		return;
	}
	
	if (strpos(wp_get_referer(), 'page=theme_activation_options') === false) {
		return;
	}
	
	update_option('uploads_use_yearmonth_folders', 0); // Avaktiverar kategoriseringen med år och månader i uploads.
	update_option( 'default_comment_status', 'closed' ); // Deaktiverar WP-kommentarer
	update_option( 'use_smilies', '0' ); // Hindrar WP från att göra om smileys i text till emojis.
	
	update_option('blogdescription', '');
	
	$current_user_id = get_current_user_id();
	update_user_meta($current_user_id, 'show_welcome_panel', 0);
	update_user_meta($current_user_id, 'show_admin_bar_front', 'false');
	
	$plugins_to_remove = array(
		'hello.php',
		'akismet/akismet.php'
	);
	
	$plugins_removed = delete_plugins($plugins_to_remove);
	
	/*
	* Tar bort alla widgets från de registrerade sidebaren.
	*/
	$widgets = get_option('sidebars_widgets');
	
	if(!empty($widgets)) {
		foreach($wp_registered_sidebars as $sidebar_slug => $sidebar_data) {
			if(!empty($widgets[$sidebar_slug])) {
				$widgets['wp_inactive_widgets'] = array_merge($widgets['wp_inactive_widgets'], $widgets[$sidebar_slug]);
				$widgets[$sidebar_slug] = array();
			}
		}

		update_option('sidebars_widgets', $widgets);
	}
	/*
	* Slut
	*/

	if ($vektor_theme_activation_options['create_front_page'] === 'true') {
		$vektor_theme_activation_options['create_front_page'] = false;
		
		$default_pages = array('Home');
		$existing_pages = get_pages();
		$temp = array();
		
		foreach ($existing_pages as $page) {
		  $temp[] = $page->post_title;
		}
		
		$pages_to_create = array_diff($default_pages, $temp);
		
		foreach ($pages_to_create as $new_page_title) {
			$add_default_pages = array(
				'post_title' => $new_page_title,
				'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat, orci ac laoreet cursus, dolor sem luctus lorem, eget consequat magna felis a magna. Aliquam scelerisque condimentum ante, eget facilisis tortor lobortis in. In interdum venenatis justo eget consequat. Morbi commodo rhoncus mi nec pharetra. Aliquam erat volutpat. Mauris non lorem eu dolor hendrerit dapibus. Mauris mollis nisl quis sapien posuere consectetur. Nullam in sapien at nisi ornare bibendum at ut lectus. Pellentesque ut magna mauris. Nam viverra suscipit ligula, sed accumsan enim placerat nec. Cras vitae metus vel dolor ultrices sagittis. Duis venenatis augue sed risus laoreet congue ac ac leo. Donec fermentum accumsan libero sit amet iaculis. Duis tristique dictum enim, ac fringilla risus bibendum in. Nunc ornare, quam sit amet ultricies gravida, tortor mi malesuada urna, quis commodo dui nibh in lacus. Nunc vel tortor mi. Pellentesque vel urna a arcu adipiscing imperdiet vitae sit amet neque. Integer eu lectus et nunc dictum sagittis. Curabitur commodo vulputate fringilla. Sed eleifend, arcu convallis adipiscing congue, dui turpis commodo magna, et vehicula sapien turpis sit amet nisi.',
				'post_status' => 'publish',
				'post_type' => 'page'
			);
		
			$result = wp_insert_post($add_default_pages);
		}
		
		$home = get_page_by_title('Home');
		update_option('show_on_front', 'page');
		update_option('page_on_front', $home->ID);
		
		$home_menu_order = array(
			'ID' => $home->ID,
			'menu_order' => -1,
		);
		wp_update_post($home_menu_order);
	}

	if ($vektor_theme_activation_options['change_permalink_structure'] === 'true') {
		$vektor_theme_activation_options['change_permalink_structure'] = false;
		
		if (get_option('permalink_structure') !== '/%category%/%postname%/') {
			global $wp_rewrite;
			$wp_rewrite->set_permalink_structure('/%category%/%postname%/');
			flush_rewrite_rules();
		}
	}

	if ($vektor_theme_activation_options['create_navigation_menus'] === 'true') {
		$vektor_theme_activation_options['create_navigation_menus'] = false;
		
		$vektor_nav_theme_mod = false;
		
		$primary_nav = wp_get_nav_menu_object('Primary Navigation');
		
		if (!$primary_nav) {
			$primary_nav_id = wp_create_nav_menu('Primary Navigation', array('slug' => 'primary_navigation'));
			$vektor_nav_theme_mod['primary_navigation'] = $primary_nav_id;
		} else {
			$vektor_nav_theme_mod['primary_navigation'] = $primary_nav->term_id;
		}
		
		if ($vektor_nav_theme_mod) {
			set_theme_mod('nav_menu_locations', $vektor_nav_theme_mod);
		}
	}
	
	if ($vektor_theme_activation_options['add_pages_to_primary_navigation'] === 'true') {
		$vektor_theme_activation_options['add_pages_to_primary_navigation'] = false;
		
		$primary_nav = wp_get_nav_menu_object('Primary Navigation');
		$primary_nav_term_id = (int) $primary_nav->term_id;
		$menu_items= wp_get_nav_menu_items($primary_nav_term_id);
		
		if (!$menu_items || empty($menu_items)) {
			$pages = get_pages();
			
			foreach($pages as $page) {
				$item = array(
					'menu-item-object-id' => $page->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish'
				);
				wp_update_nav_menu_item($primary_nav_term_id, 0, $item);
			}
		}
	}
	
	update_option('vektor_theme_activation_options', $vektor_theme_activation_options);
}

add_action('admin_init','vektor_theme_activation_action');

function vektor_deactivation() {
	delete_option('vektor_theme_activation_options');
}

add_action('switch_theme', 'vektor_deactivation');
