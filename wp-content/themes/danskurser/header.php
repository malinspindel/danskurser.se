<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta charset="UTF-8">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="https://hittadanskurs.se/wp-content/uploads/favicon.ico" rel="shortcut icon">
        <link href="https://hittadanskurs.se/wp-content/uploads/touch.png" rel="apple-touch-icon-precomposed">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
      // conditionizr.com
      // configure environment tests
      conditionizr.config({
          assets: '<?php echo get_template_directory_uri(); ?>',
          tests: {}
      });

      $(document).ready(function() {
          $("#city").select2({
                  placeholder: "Select a State",
                  allowClear: true
           });
      });
		</script>

	</head>
	<body <?php body_class(); ?>>
		<!--Div to hide body while loading-->
		<div style="display: none" id="hideAll">&nbsp;</div>
	<script type="text/javascript">
	   document.getElementById("hideAll").style.display = "block";

		 window.onload = function()
  	{ document.getElementById("hideAll").style.display = "none"; }
	 </script>

			<!-- header -->
			<header class="header clear" role="banner">

				<div class="row">

					<!-- logo -->
					<div class="logo small-4 medium-4 columns">
						<a href="<?php echo home_url(); ?>">
							<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="logo-img">
						</a>
					</div>
					<!-- /logo -->

					<!-- nav -->
					<nav class="nav small-8 medium-8 columns" role="navigation">
						<div class="free-search-box hover-opacity">
								<?php echo do_shortcode( '[free_search]' ); ?>
							<span class="free-search-icon"><i class="fa fa-search"></i></span>
						</div>
						<?php wp_nav_menu(); ?>

					</nav>
					<!-- /nav -->

					<div id="popup-info">

						<h3>PSST...</h3>
						<p>
							HÄR KAN DU SÖKA PÅ <STRONG>DANSLÄRARE ELLER SKOLA</STRONG>.
						</p>
						<p>
							DU HITTAR ÄVEN <strong>MENY</strong> FÖR MER INFO &amp; KONTAKT!
						</p>
						<p class="popup-close"><i class="fa fa-check"></i></p>

					</div>


			</header>
			<!-- /header -->
