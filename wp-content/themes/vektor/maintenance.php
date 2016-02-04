<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<title><?php wp_title('-', true, 'right'); ?></title>
		
		<?php noindex(); ?>
		
		<script src="<?php echo vektor_dir('/lib/js/modernizr.min.js'); ?>"></script>

		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/lib/img/favicon.png">
		
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/lib/img/favicon.ico" type="image/x-icon">
		
		<link rel="stylesheet" href="<?php echo vektor_dir('/lib/css/login.css'); ?>">

		<style type="text/css">
		
			#login {
				margin: auto;
				text-align: center;
			}
			
		</style>
	</head>

	<body class="wp-core-ui">
	
		<div id="login" class="login">
		
			<h1>
				
				<a id="logo" href="<?php echo home_url(); ?>"><?php echo bloginfo('name'); ?></a>
			
			</h1>
			
			<p>
	
				<a class="button button-large button-primary" rel="nofollow" href="<?php echo wp_login_url($_SERVER['REQUEST_URI']); ?>">
					<?php _e('Log in'); ?>
				</a>
	
			</p>
			
		</div> <!-- /#login -->
		
	</body>

</html>