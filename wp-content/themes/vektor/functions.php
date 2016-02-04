<?php

/*
 * Vektor includes
 */

$selectable_files = array(
	'/lib/inc/post-types.php' // Custom post types
);

foreach($selectable_files as $selectable_file)
	locate_template($selectable_file, true);








/*
 * Stop edit here!
 */

$required_files = array(
	'custom.php',
	'init.php',
	'config.php',
	'activation.php',
	'cleanup.php',
	'titles.php',
	'nav.php',
	'admin.php',
	'widgets.php',
	'scripts.php'
);
	
foreach($required_files as $required_file)
	locate_template('/lib/inc/' . $required_file, true);

$plugin_files = array(
	'vektor-menu.php', // vektor_menu(), replaces simple_section_nav()
	'vektor-download.php', // get_the_download_attachment_url() and the_download_attachment_url()
	'vektor-maintenance-mode.php', // To activate maintenance mode, set MAINTENANCE_MODE to true in config.php
	'vektor-lang.php', // Easier po/mo language files management
	'instagram.class.php', // Instagram PHP API: https://github.com/cosenary/Instagram-PHP-API
);

foreach($plugin_files as $plugin_file)
	locate_template('/lib/inc/plugins/' . $plugin_file, true);
