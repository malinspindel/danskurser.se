			<!-- footer -->
			<footer class="footer " role="contentinfo">

				<section class="row padding-top-bottom">
					<div class="columns small-12 medium-6 large-6 text-right padding-sides">
						<h3>SOCIALA MEDIER</h3>
						<ul>
							<li>Besök oss på Facebook här</li>
							<li>Besök oss på Instagram här</li>
						</ul>
					</div>

					<div class="columns small-12 medium-6 large-6 padding-sides">
						<h3>KONTAKT</h3>
						<ul>
							<li>info@danskurser.se</li>
							<li>Eller klicka här.</li>
						</ul>
					</div>


				</section>

				<!-- copyright -->
				<!-- <p class="copyright">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'danskurser.se'); ?>
					<a href="//malinspindel.se" title="Malin">Malin</a> &amp; <a href="//danskurser.se" title="danskurser.se">danskurser.se</a>.
				</p> -->
				<!-- /copyright -->

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<?php
			if(is_home())
			{
			if (function_exists (mypopup)) mypopup();
			}
		?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
