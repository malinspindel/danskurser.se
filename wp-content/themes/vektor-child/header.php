<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
	
		<meta charset="utf-8">
		
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<title><?php wp_title('-', true, 'right'); ?></title>
		
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/lib/img/favicon.png">
		
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/lib/img/favicon.ico" type="image/x-icon">
		<li><?php echo $name; ?></li>
		<?php wp_head(); ?>
		
	</head>
	
	<body <?php body_class(); ?>>
	
	<!--[if lt IE 9]><p class="chromeframe"><?php _e('Your browser is <em>ancient!</em>', 'vektor'); ?> <a href="http://browsehappy.com/"><?php _e('Upgrade to a different browser', 'vektor'); ?></a> <?php _e('to experience this site.', 'vektor'); ?></p><![endif]-->
	
	<header id="header">
		
		<!--Top-nav-->
		<?php
			
		$email = false; $phone = false;

		if(function_exists('get_field')):

		$email = get_field('contact_email', 'option');
		$phone = get_field('contact_phone', 'option');

		endif;

		?>
		
		<div id="top-nav" class="">
			<div class="row">
				<div class ="medium-12 columns text-uppercase">
					<?php if($email || $phone): ?>
						<ul class = "top-nav-container text-right">
					<?php endif; ?>

						<?php if($email): ?>
							<li><i class="fa fa-phone"></i><a href="#"><?php echo $email; ?></a></li>
						<?php endif; ?>

						<?php if($phone): ?>
							<li><i class="fa fa-envelope"></i><a href="#"><?php echo $phone; ?></a></li>
						<?php endif; ?>

						<?php vektor_top_nav(); ?>

					<?php if($email || $phone): ?>
					</ul>
					<?php endif; ?>		
				

				</div>	<!-- end medium-12 -->
			</div>		<!-- end .row -->
		</div> <!-- end .top-nav -->
		
		
		<div class="row">
		
			<div class="medium-12 columns">
			
				<a href="<?php echo home_url(); ?>" id="logo"><?php bloginfo('name'); ?></a>
				
				<div id="toggle">
				
					<span></span>
					
					<span></span>
					
					<span></span>

					<div class="toggle-text"><?php _e('Menu', 'vektor'); ?></div>
					
				</div> <!-- /#toggle -->
				
				<nav id="nav">
				
					<?php vektor_nav(); ?>
					
				</nav>
				
			</div> <!-- /.medium-12 -->
			
		</div> <!-- /.row -->
			
	</header>
	
	<div id="wrap">
	
		<div id="content">