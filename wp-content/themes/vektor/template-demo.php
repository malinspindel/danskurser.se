<?php
/*
 * Template Name: Demo
 */
?>
<?php get_header(); ?>

<?php get_template_part('templates/top-section'); ?>

<section class="layout space small">

	<div class="row">

		<div class="medium-12 columns">
			
			<h2>ScrollTo</h2>
			
			<p><a href="#instagram" class="btn scroll-to">Scroll to Instagram</a></p>
			
			<p><a href="https://github.com/flesler/jquery.scrollTo" target="_blank">Download &amp; documentation</a></p>
			
			<hr />
			
			<h2>Slick slider</h2>
			
			<p><a href="https://github.com/kenwheeler/slick" target="_blank">Download &amp; documentation</a></p>
			
			<pre>
			
				<code>
				
$('.slick-slider').slick();
				
				</code>
			
			</pre>
			
			<div class="slick-slider">
			
				<div>
				
					<img src="<?php echo vektor_dir('lib/media/image-01.jpg'); ?>" alt="">
				
				</div>
				
				<div>
				
					<img src="<?php echo vektor_dir('lib/media/image-01.jpg'); ?>" alt="">
				
				</div>
				
				<div>
				
					<img src="<?php echo vektor_dir('lib/media/image-01.jpg'); ?>" alt="">
				
				</div>
			
			</div> <!-- /.slick-slider -->
		
			<hr />

			<h2>Font Awesome</h2>

			<p><a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Download &amp; documentation</a></p>
			
			<p><a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Full list of available icons</a></p>

			<h3>Basic icons</h3>

			<p><i class="fa fa-camera-retro"></i> fa-camera-retro</p>

			<h3>Larger icons</h3>

			<p><i class="fa fa-camera-retro fa-lg"></i> fa-lg</p>

			<p><i class="fa fa-camera-retro fa-2x"></i> fa-2x</p>

			<p><i class="fa fa-camera-retro fa-3x"></i> fa-3x</p>

			<p><i class="fa fa-camera-retro fa-4x"></i> fa-4x</p>

			<p><i class="fa fa-camera-retro fa-5x"></i> fa-5x</p>

			<h3>Spinning icons</h3>

			<p>

				<i class="fa fa-spinner fa-spin"></i>

				<i class="fa fa-circle-o-notch fa-spin"></i>

				<i class="fa fa-refresh fa-spin"></i>

				<i class="fa fa-cog fa-spin"></i>

			</p>

			<h3>Stacked icons</h3>

			<p>

				<span class="fa-stack fa-lg">

					<i class="fa fa-square-o fa-stack-2x"></i>

					<i class="fa fa-twitter fa-stack-1x"></i>

				</span>

				fa-twitter on fa-square-o

			</p>

			<p>

				<span class="fa-stack fa-lg">

					<i class="fa fa-circle fa-stack-2x"></i>

					<i class="fa fa-flag fa-stack-1x fa-inverse"></i>

				</span>

				fa-flag on fa-circle

			</p>

			<p>

				<span class="fa-stack fa-lg">

					<i class="fa fa-square fa-stack-2x"></i>

					<i class="fa fa-terminal fa-stack-1x fa-inverse"></i>

				</span>

				fa-terminal on fa-square

			</p>

			<p>

				<span class="fa-stack fa-lg">

					<i class="fa fa-camera fa-stack-1x"></i>

					<i class="fa fa-ban fa-stack-2x text-danger"></i>

				</span>

				fa-ban on fa-camera

			</p>
		
			<hr />

			<h2>Selecter</h2>
			
			<p><a href="http://formstone.it/components/selecter" target="_blank">Download &amp; documentation</a></p>
			
			<pre>
			
				<code>
				
$('select').selecter();
				
				</code>
			
			</pre>
			
			<select data-label="<?php _e('Select an item', 'vektor'); ?>">
			
				<option>Option 1</option>
				
				<option>Option 2</option>
				
				<option>Option 3</option>

				<option>Option 4</option>
				
				<option>Option 5</option>
				
				<option>Option 6</option>

				<option>Option 7</option>
				
				<option>Option 8</option>
				
				<option>Option 9</option>

				<option>Option 10</option>
			
			</select>

			<hr />

			<h2>Tabber</h2>
			
			<p><a href="http://formstone.it/components/tabber" target="_blank">Download &amp; documentation</a></p>
			
			<pre>
			
				<code>
				
$(".tabbed").tabber();

				</code>
				
			</pre>
			
			<div class="tabbed">

				<menu class="tabber-menu">

					<a href="#tab-1" class="tabber-handle">Tab 1</a>

					<a href="#tab-2" class="tabber-handle">Tab 2</a>

					<a href="#tab-3" class="tabber-handle">Tab 3</a>

				</menu>

				<div class="tabber-tab" id="tab-1">

					Content 1...

				</div> <!-- /.tabber-tab -->

				<div class="tabber-tab" id="tab-2">

					Content 2...

				</div> <!-- /.tabber-tab -->

				<div class="tabber-tab" id="tab-3">

					Content 3...

				</div> <!-- /.tabber-tab -->

			</div> <!-- /.tabbed -->

			<hr />

			<h2>Accordion</h2>
			
			<p><a href="http://jqueryui.com/accordion/" target="_blank">Download &amp; documentation</a></p>
			
			<pre>
			
				<code>
				
$('.accordion').accordion({
	collapsible: true,
	header: '.accordion-header',
	heightStyle: 'content'
});

				</code>
				
			</pre>
			
			<div class="accordion">

				<div class="accordion-item">

					<div class="accordion-header">

						<div>

							<h3 class="h4">Lorem ipsum</h3>

						</div>

					</div> <!-- /.accordion-header -->

					<div class="accordion-content">

						<div>

							<p>Lorem ipsum dolor sit amet</p>

						</div>

					</div> <!-- /.accordion-content -->

				</div> <!-- /.accordion-item -->

				<div class="accordion-item">

					<div class="accordion-header">

						<div>

							<h3 class="h4">Lorem ipsum</h3>

						</div>

					</div> <!-- /.accordion-header -->

					<div class="accordion-content">

						<div>

							<p>Lorem ipsum dolor sit amet</p>

						</div>

					</div> <!-- /.accordion-content -->

				</div> <!-- /.accordion-item -->

				<div class="accordion-item">

					<div class="accordion-header">

						<div>

							<h3 class="h4">Lorem ipsum</h3>

						</div>

					</div> <!-- /.accordion-header -->

					<div class="accordion-content">

						<div>

							<p>Lorem ipsum dolor sit amet</p>

						</div>

					</div> <!-- /.accordion-content -->

				</div> <!-- /.accordion-item -->

				<div class="accordion-item">

					<div class="accordion-header">

						<div>

							<h3 class="h4">Lorem ipsum</h3>

						</div>

					</div> <!-- /.accordion-header -->

					<div class="accordion-content">

						<div>

							<p>Lorem ipsum dolor sit amet</p>

						</div>

					</div> <!-- /.accordion-content -->

				</div> <!-- /.accordion-item -->

			</div> <!-- /.accordion -->

			<hr />
			
			<h2 id="instagram">Instagram</h2>
			
			<?php
			
				$instagram = new Instagram(array(
					'apiKey' => 'eb1331168f74403fb93a90b588c6e1dd',
					'apiSecret' => '87d758cd0dfe480aa538016279b68ff6',
					'apiCallback' => 'http://new.vgdev.se/'
				));
				
				$instagram->setAccessToken('1152729528.eb13311.5490defa09ca4d1bb02ebe5dd9486f31');
				
				$user_id = 223597775; // Get ID from Instagram username: http://jelled.com/instagram/lookup-user-id
				$limit = 7;
				
				$user_media = $instagram->getUserMedia($user_id, $limit);
				
			?>
			
			<?php foreach($user_media->data as $data): ?>
				
				<a href="<?php echo $data->images->standard_resolution->url; ?>" rel="instagram-feed"><img src="<?php echo $data->images->thumbnail->url; ?>" alt="<?php echo implode($data->tags, ' '); ?>"></a>
			
			<?php endforeach; ?>
		
			<hr />
		
			<h2>Twitter</h2>
			
			<?php get_template_part('lib/inc/plugins/tweets'); ?>
			
			<hr />
			
			<h2>Modal</h2>

			<a href="#" class="btn" data-toggle="modal" data-target="#myModal">Launch demo modal</a>
			
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				
				<div class="modal-dialog">
					
					<div class="modal-content">
						
						<div class="modal-header">
							
							<a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></a>
							
							<h4 class="modal-title" id="myModalLabel">Modal title</h4>
							
						</div> <!-- /.modal-header -->
						
						<div class="modal-body">
							
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus non ligula quis dolor interdum scelerisque. Maecenas fermentum ligula est, ac tempor enim sollicitudin a.
							
						</div> <!-- /.modal-body -->
						
					</div> <!-- /.modal-content -->
					
				</div> <!-- /.modal-dialog -->
				
			</div> <!-- /.modal -->
			
			<hr />
			
			<h2>Superslides</h2>
			
			<p><a href="https://github.com/nicinabox/superslides" target="_blank">Download &amp; documentation</a></p>
			
			<pre>
				
				<code>
				
$('.superslides').superslides();
				
				</code>
			
			</pre>
			
		</div> <!-- /.medium-12 -->
	
	</div> <!-- /.row -->
	
	<div class="superslides">
	
		<ul class="slides-container">
		
			<li>
			
				<img src="<?php echo vektor_dir('lib/media/image-01.jpg'); ?>" alt="">
			
			</li>
			
			<li>
			
				<img src="<?php echo vektor_dir('lib/media/image-01.jpg'); ?>" alt="">
			
			</li>
		
		</ul> <!-- /.slides-container -->
	
	</div> <!-- /.superslides -->
	
	<div class="row">
	
		<div class="medium-12 columns">
		
			<h2>Google Maps</h2>
		
		</div> <!-- /.medium-12 columns -->
	
	</div> <!-- /.row -->
	
</section>

<?php get_footer(); ?>