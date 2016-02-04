<?php

class Vektor_Maintenance_Mode {
	
	private $activated = null;

	function __construct() {
		
		add_action('wp', array($this, 'wp'));
		add_action('admin_init', array($this, 'admin_init'));

		// Inställningssidan visas endast om vi är inloggade.
		if(is_vektor_logged_in()) {
			add_action('admin_menu', array($this, 'admin_menu'));
		}
	}
	
	function wp() {
		// Aktiverar maintenance mode om det är aktiverat för det aktiva språket.
		if($this->is_activated()) {
			add_action('template_redirect', array($this, 'activate_maintenance_mode'));
		}
	}
	
	function admin_init() {
		register_setting('vektor-maintenance-mode-group', $this->_get_option_name());
	}
	
	function admin_menu() {
		// Visar en admin varning om det språket som är aktivt har maintenance mode aktivt.
		
		
		// Lägger till inställningssidan.
		$hook_suffix = add_options_page('Maintenance Mode', 'Maintenance Mode', 'manage_options', 'vektor-maintenance-mode', array($this, 'display_admin_page'));
		
		if($this->is_activated()) {
			add_action('load-' . $hook_suffix, array($this, 'load_admin_page'));
		}
	}
	
	function load_admin_page() {
		add_action('admin_notices', array($this, 'admin_notice'));
	}
	
	/*
	 * HTML för admin varningen.
	 */
	function admin_notice() {
		?>
		<div class="error">
			<p>
				<strong>OBS:</strong> Maintenance Mode är aktivt.<br>
				Kundlänk: <a href="<?php echo $this->_get_home_url('?guest'); ?>"><?php echo $this->_get_home_url('?guest'); ?></a> <small>(för 7 dagars tillträde)</small>
			</p>
		</div>
		<?php
	}
	
	/*
	 * Kollar att maintenance mode är aktiverat för det aktiva språket.
	 */
	function is_activated() {
		if(is_null($this->activated)) {
			$this->option = get_option($this->_get_option_name()); // Hämtar inställningen ifrån databasen.
			
			// Om inställningen inte finns än läggs den till med standardvärdet, som är aktiverat för det aktiva språket.
			if($this->option === false) {
				add_option($this->_get_option_name(), 'y', null, true);
				$this->activated = true;
			} else {
				$this->activated = bool_from_yn($this->option);
			}
		}
		
		return $this->activated;
	}
	
	/*
	 * HTML för inställningssidan.
	 */
	function display_admin_page() {
		ob_start();
		?>
		<div class="wrap">
			<h2><?php echo get_admin_page_title(); ?></h2>
			<form action="options.php" method="post">
				<?php settings_fields('vektor-maintenance-mode-group'); ?>
				
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<?php _e('Maintenance Mode Active', 'vektor'); ?><br>
							<i>För språk: <?php echo $this->_get_locale(); ?></i>
						</th>
						<?php $maintenance_mode_active = get_option($this->_get_option_name()); ?>
						<td>
							<fieldset>
								<label>
									<input type="radio" name="<?php echo $this->_get_option_name(); ?>" value="y" <?php checked('y', $maintenance_mode_active); ?>/> <?php _e('Yes'); ?><br>
								</label>
								<br>
								<label>
									<input type="radio" name="<?php echo $this->_get_option_name(); ?>" value="n" <?php checked('n', $maintenance_mode_active); ?>/> <?php _e('No'); ?>
							</label>
							</fieldset>
						</td>
					</tr>
				</table>

				<?php submit_button(__('Save changes'), 'primary'); ?>
			</form>
		</div>
		<?php
		ob_end_flush();
	}
	
	/*
	 * Sätter igång maintenance mode.
	 */
	function activate_maintenance_mode() {
		$this->_activate_maintenance_mode();
	}
	
	/*
	 * This is where the magic happens :)
	 */
	private function _activate_maintenance_mode() {
		global $pagenow;
		
		if(is_localhost())
			return;
		
		// Vi måste låta WP_Cron köras även om maintenance mode är aktivt.
		if(defined('DOING_CRON') && DOING_CRON)
			return;
		
		// Är det vektorgrafik som är inloggade?
		if(is_vektor_logged_in())
			return;
		
		// Har besökaren gästcookien satt eller ska den sättas?
		if($this->_check_maintenance_guest_cookie())
			return;

		// Möjliggör för W3C Validator och Facebook att komma åt siten även om maintenance mode är aktiverat.
		if(preg_match('/W3C_Validator|facebook/i', $_SERVER['HTTP_USER_AGENT']))
			return;

		// Är besökaren inloggad eller är redan i admin?
		if(is_user_logged_in() || is_admin())
			return;

		// Är besökaren på inloggnings- eller registreringssidan? 
		if(in_array($pagenow, array('wp-login.php', 'wp-signup.php')))
			return;

		$maintenance_mode_filename = 'maintenance.php';
		$maintenance_mode_file = trailingslashit(get_template_directory()) . $maintenance_mode_filename;

		if(file_exists($maintenance_mode_file) && is_readable($maintenance_mode_file)) {
			if(!headers_sent()) {
				nocache_headers();
				
				@header('X-Maintenance-Mode: Active');

				// Skickar HTTP statusen 503 (Service Unavailable)
				if(function_exists('http_response_code'))
					http_response_code(503);
				else
					header('HTTP/1.1 503 Service Unavailable');
			}

			include $maintenance_mode_file;
			exit;
		} else {
			wp_die(__('Vektor Maintenance Mode active', 'vektor'), get_bloginfo('blogname') . ' - ' . __('Maintenance Mode', 'vektor'));
		}
	}
	
	/*
	 * Kollar om gästcookien är satt eller om den behöver sättas.
	 * Cookien ger enheten tillgång till HELA siten, (inte bara det aktiva språket) i 7 dygn.
	 * Skicka med ?guest i URL:en för att ge en besökare tillgång utan ett användarkonto.
	 */
	private function _check_maintenance_guest_cookie() {
		if(!empty($_COOKIE['vektor_maintenance_guest']) && $_COOKIE['vektor_maintenance_guest'] == '1') {
			wp_set_current_user(1);
			return;
		}
			
		// Om ?guest eller &guest finns med i URL:en och HTTP headers inte har skickats än sätter vi en cookie som går ut om 7 dygn.
		if(isset($_GET['guest']) && !headers_sent()) {
			setcookie('vektor_maintenance_guest', '1', time() + 60*60*24*7);
			wp_set_current_user(1);
			return true;
		}

		return false;
	}
	
	/*
	 * Hämtar inställningsnamnet.
	 */
	private function _get_option_name() {
		$current_locale = $this->_get_locale();
		
		return 'vektor_mm_' . $current_locale;
	}
	
	/*
	 * Hämtar det aktiva språkets "locale" med hänsyn till Polylang.
	 */
	private function _get_locale() {
		global $sitepress, $polylang;
		
		// Hämtar Wordpress aktiva "locale".
		$current_locale = get_locale();
		
		if(defined('ICL_LANGUAGE_CODE')) { // Är WPML eller Polylang installerat och aktiverat?
			$current_locale = ICL_LANGUAGE_CODE; // Hämtar det aktiva språket.
		}
		
		if($current_locale === 'all') {
			if(isset($sitepress)) {
				$current_locale = $sitepress->get_default_language();
			} else if(function_exists('pll_default_language')) {
				$current_locale = pll_default_language();
			} else {
				$current_locale = get_locale();
			}
		}
		
		$current_lang_code = mb_substr($current_locale, 0, 2);
		
		return $current_lang_code;
	}
	
	/*
	 * Hämtar startsidans URL med hänsyn till Polylang.
	 */
	private function _get_home_url($path = '') {
		
		// Hämtar Wordpress startsidas URL.
		$home_url = home_url();
		
		if(function_exists('icl_get_home_url')) {
			
			$home_url = icl_get_home_url();
			
		} else if(function_exists('pll_home_url')) {// Är Polylang installerat och aktiverat?
			
			// Hämtar Polylang´s startsidas URL i det aktiva språket.
			$home_url = pll_home_url();
			
		}
		
		return trailingslashit($home_url) . $path;
	}
	
}

global $vektor_mm;
$vektor_mm = new Vektor_Maintenance_Mode();

/*
 * Funktion för att lättare kolla om maintenance mode är aktivt.
 */
function is_vektor_mm_activated() {
	global $vektor_mm;
	return $vektor_mm->is_activated();
}