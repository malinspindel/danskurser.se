<?php get_header(); ?>

<?php the_post(); ?>

<?php get_template_part('templates/top-section'); ?>

<?php if($post->post_content!=""): ?>

<section class="single-case-section space small layout">

	<div class="row">
	
		<article class="medium-8 large-7 columns">
			
			<div class="entry-content">
			
				<?php the_content(); ?>

				<?php
				// Find connected pages
				$connected = new WP_Query( array(
				  'connected_type' => 'cases_to_services',
				  'connected_items' => get_queried_object(),
				  'nopaging' => true,
				) );

				// Display connected pages
				if ( $connected->have_posts() ) :
				?>
				<ul class="connected-services">
				<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>

				<?php
				// Prevent weirdness
				wp_reset_postdata();

				endif;
				?>
				
			</div> <!-- /.entry-content -->
			
		</article>
		
		<aside class="columns medium-4 large-4 large-offset-1 sidebar">

			<?php get_template_part('templates/layout/social'); ?>
			
		</aside>
		
	</div> <!-- /.row -->

</section>

<?php endif; ?>

<?php wp_reset_query(); get_template_part('templates/flexible-content'); ?>
	
<?php get_footer(); ?>