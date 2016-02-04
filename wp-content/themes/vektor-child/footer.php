			<?php
			
			$name = false; $email = false; $phone = false; $address = false; $zip = false; $city = false; $country = false;

			if(function_exists('get_field')):

				$name = get_field('contact_name', 'option');
			$email = get_field('contact_email', 'option');
			$phone = get_field('contact_phone', 'option');
			$address = get_field('contact_address', 'option');
			$zip = get_field('contact_zip', 'option');
			$city = get_field('contact_city', 'option');
			$country = get_field('contact_country', 'option');
			$directions = get_field('contact_directions', 'option');

			$facebook = get_field('social_facebook', 'option');
			$twitter = get_field('social_twitter', 'option');
			$instagram = get_field('social_instagram', 'option');
			$linkedin = get_field('social_linkedin', 'option');
			$googleplus = get_field('social_googleplus', 'option');

			endif;

			?>
			<!--Facebook-Like-Button-->
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.5";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			
		</div> <!-- /#content -->
		
	</div> <!-- /#wrap -->

</div>

<footer id="footer" class=
				"clearfix">

	<div id="contact_form" class="footer-form small-12 medium-6 columns right clear-padding">

		<div class="row clear-padding">

			<div class="medium-12 columns text-center">

				<h3 class="clear-margin space smallest"><?php _e('Contact us', 'vektor'); ?></h3>

			</div>

			<div class="form-container medium-12 columns text-center clear-padding">

				<?php echo do_shortcode('[contact-form-7 id="116" title="Kontakta Oss"]'); ?>

			</div>	

		</div> <!-- /.row -->

	</div> <!-- /.footer-form -->


	<div class="footer-map small-12 medium-6 columns clear-padding">

		<?php if(get_field('contact_location', 'options')): ?>

		<div id="map-canvas"></div>
		
	<?php endif; ?>
	
	<div class="footer-info space smaller">

		<div class="row">

			<div class="medium-12 columns">

				<?php if($name): ?>
				<strong class="footer-title"><?php echo $name; ?></strong>
			<?php endif; ?>

			<ul>

				<?php if($address): ?>
				<li class="address"><?php echo $address; ?></li>
			<?php endif; ?>

			<?php if($zip || $city): ?>
			<li class="zip"><?php echo $zip; ?> <?php echo $city; ?></li>
		<?php endif; ?>

		<?php if($country): ?>
		<li class="country"><?php echo $country; ?></li>
	<?php endif; ?>
								<?php /* if($email): ?>
									<li class="email"><a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a></li>
								<?php endif; */ ?>

								<?php if($phone): ?>
								<li class="phone"><?php _e('Phone: ', 'vektor'); ?><?php echo $phone; ?></li>
							<?php endif; ?>

						</ul>

						<!-- Like Facebook Page
						<div class="fb-like" data-href="https://www.facebook.com/Chimneytec-AB-712338145461382/" data-width="150" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>-->

						<ul>

							<?php if($directions): ?>
							<li class="country"><?php echo $directions; ?></li>
						<?php endif; ?>

					</ul>

<!--
							<ul class="social">

								<?php if($facebook): ?>
									<li class="facebook"><a target="_blank" href="<?php echo $facebook; ?>"><i class="fa fa-facebook fa-lg"></i></a></li>
								<?php endif; ?>

								<?php if($twitter): ?>
									<li class="twitter"><a target="_blank" href="<?php echo $twitter; ?>"><i class="fa fa-twitter fa-lg"></i></a></li>
								<?php endif; ?>

								<?php if($instagram): ?>
									<li><a target="_blank" href="<?php echo $instagram; ?>"><i class="fa fa-instagram fa-lg"></i></a></li>
								<?php endif; ?>

								<?php if($linkedin): ?>
									<li><a target="_blank" href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin fa-lg"></i></a></li>
								<?php endif; ?>

								<?php if($googleplus): ?>
									<li><a target="_blank" href="<?php echo $googleplus; ?>"><i class="fa fa-google-plus fa-lg"></i></a></li>
								<?php endif; ?>

							</ul>
						-->

					</div> <!-- /.medium-4 -->

<!--
						<div class="medium-4 columns">
	
							<strong><?php echo wp_nav_menu_title('footer_navigation'); ?></strong>
	
							<?php vektor_footer_nav(); ?>
	
						</div>
					--> <!-- /.medium-4 -->

				</div> <!-- /.row -->

			</div>

		</div> <!-- /.footer-map -->


		


<!--
			<?php get_template_part('templates/certifikat-footer'); ?>	
		-->








	</footer>

	<?php wp_footer(); ?>

</body>

</html>