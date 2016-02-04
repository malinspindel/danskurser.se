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

					$facebook = get_field('social_facebook', 'option');
					$twitter = get_field('social_twitter', 'option');
					$instagram = get_field('social_instagram', 'option');
					$linkedin = get_field('social_linkedin', 'option');
					$googleplus = get_field('social_googleplus', 'option');

				endif;
				
			?>
			
			</div> <!-- /#content -->
		
		</div> <!-- /#wrap -->
		
		<footer id="footer">

			<div class="footer-form space">

				<div class="row">

					<div class="medium-12 columns text-center">

						<h3 class=""><?php _e('Send us a message', 'vektor'); ?></h3>

					</div>
					
					<div class="medium-12 large-10 large-centered columns text-center">

						<?php echo do_shortcode('[vektor_form]'); ?>

					</div>
					

				</div>

				

			</div>

			<?php if(get_field('contact_location', 'options')): ?>
				<div id="map-canvas"></div>
			<?php endif; ?>

			<div class="footer-info space small">

				<div class="row">

					<div class="medium-4 columns">

						<?php if($name): ?>
							<strong><?php echo $name; ?></strong>
						<?php endif; ?>

						<ul>
							<?php if($email): ?>
								<li class="email"><a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a></li>
							<?php endif; ?>

							<?php if($phone): ?>
								<li class="phone"><?php echo $phone; ?></li>
							<?php endif; ?>
						</ul>
						
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
						</ul>

					</div> <!-- /.medium-4 -->

					<div class="medium-4 columns">

						<strong><?php echo wp_nav_menu_title('footer_navigation'); ?></strong>

						<?php vektor_footer_nav(); ?>

					</div> <!-- /.medium-4 -->

					<div class="medium-4 columns">

						<strong><?php _e('Subscribe to our newsletter', 'vektor'); ?></strong>

					</div> <!-- /.medium-4 -->

				</div> <!-- /.row -->

			</div>

			<div class="footer-bottom">

				<div class="row">

					<div class="columns medium-12">

						<div class="right">

							<ul class="social">

								<?php if($facebook): ?>
									<li><a target="_blank" href="<?php echo $facebook; ?>"><i class="fa fa-facebook fa-lg"></i></a></li>
								<?php endif; ?>

								<?php if($twitter): ?>
									<li><a target="_blank" href="<?php echo $twitter; ?>"><i class="fa fa-twitter fa-lg"></i></a></li>
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

						</div>
						
						<div class="left">

							<span class="copy">&copy; <?php echo date('Y'); ?> <?php echo $name; ?></span>

						</div>

					</div>

				</div>

			</div>
			
		</footer>
		
		<?php wp_footer(); ?>
		
	</body>
	
</html>