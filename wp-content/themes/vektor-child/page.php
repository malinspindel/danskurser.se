<?php get_header(); ?>

<?php the_post(); ?>

<?php get_template_part('templates/top-section'); ?>

<!--<?php if(get_the_content()): ?>

<section class="space page-section small layout">

	<div class="row">
	
		<div class="medium-12 columns">
			
			<div class="entry-content">
			
				<?php the_content(); ?>
				
			</div>
			
		</div>
		
	</div>

</section>

<?php endif; ?>
-->

<?php get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>