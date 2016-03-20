<!-- footer -->
<footer class="footer " role="contentinfo">

	<section class="row padding-top-bottom">
			<div class="small-centered small-12 medium-12 large-12">

				 <div class="columns small-12 medium-4 large-4 padding-sides">
					<h3>HJÄLP OSS SPRIDA DANSEN</h3>
					<ul>
						<li>Vi vill att dansen endast ska vara några knapptryck bort & vil vill att alla ska dansa!</li>
						<li>Vi behöver Din hjälp för att få det att hända, om du vill vara med - kontakta oss!</li>
					</ul>
				</div>
				<div class="columns small-12 medium-4 large-4 padding-sides">
					<h3>SOCIALA MEDIER</h3>
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i>Besök oss på Facebook här</a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i>Besök oss på LinkedIn här</a></li>
					</ul>
				</div>

				<div class="columns small-12 medium-4 large-4 padding-sides">
					<h3>KONTAKT</h3>
					<ul>
						<li><a href="https://hittadanskurs.se/vanliga-fragor/"><i class="fa fa-paper-plane-o"></i>info@danskurser.se</a></li>
						<li><a href="https://hittadanskurs.se/kontakt/"><i class="fa fa-pencil-square-o"></i>Eller klicka här för formulär.</a></li>
						<li><a href="tel:0708686353"><i class="fa fa-phone"></i>0708 686 353</a></li>
					</ul>
				</div>
		</div>




	</section>

	<!-- copyright -->
	<p class="copyright">
		&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'hittadanskurs.se'); ?>
	</p>
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
