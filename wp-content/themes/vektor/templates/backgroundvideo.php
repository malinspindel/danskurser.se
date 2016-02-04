<section class="section-video top-section">

	<div id="video"></div>
	
	<div class="video-content">
	
		<div class="table">
		
			<div class="table-cell align-middle">
				
				<div class="columns medium-10 medium-centered large-8 large-centered">
				
					<?php if($title = get_field('top_title')): ?>
						<h1><?php echo $title; ?></h1>
					<?php else: ?>
						<h1><?php echo get_bloginfo('name'); ?></h1>
					<?php endif; ?>
					
					<?php if($intro = get_field('top_intro')): ?>
						<p class="intro"><?php echo $intro; ?></p>
					<?php endif; ?>
					
					<?php if($btn_text = get_field('btn_text')): ?>
						<a href="<?php the_field('btn_link_url'); ?>" class="btn"><?php echo $btn_text; ?></a>
					<?php endif; ?>
				
				</div>

			</div> <!-- /.table-cell -->
			
		</div> <!-- /.table -->
	
	</div> <!-- /.video-content -->

	<div class="scroll-to-next"></div>
	
	<div class="video-filter"></div>

	<?php if(get_field('news_slider')): ?>
		<?php get_template_part('templates/news-slider'); ?>
	<?php endif; ?>
	
</section> <!-- /.bgvideo -->