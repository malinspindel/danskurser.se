<?php get_header(); ?>

<?php the_post(); ?>

<?php get_template_part('templates/top-section'); ?>

<?php $current = $post->ID; ?>

<section class="single-service-section space small layout">

	<div class="row">
	
		<article class="medium-8 columns">
			
			<div class="entry-content">
			
				<?php the_content(); ?>

			</div> <!-- /.entry-content -->
			
		</article>

		<?php
			$wp_query = new WP_Query(
				array(
					'post_type' => 'service',
					'posts_per_page' => -1
				)
			);
		?>

		<?php if($wp_query->have_posts()): ?>

			<aside class="columns medium-4 sidebar">

				<nav>

					<ul class="service-list">

						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

							<li<?php if($current == $post->ID): ?> class="current_page_item"<?php endif; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

						<?php endwhile; ?>

					</ul>

				</nav>

			</aside>

		<?php endif; wp_reset_query(); ?>

	</div>

</section>

<?php if(get_field('show_cases')): ?>

	<section class="connected-cases layout layout-cases space">

		<div class="row">

			<div class="columns medium-12">

				<h3><?php _e('Related cases', 'vektor'); ?></h3>

				<?php

				if($cases = get_field('cases')):

					foreach($cases as $case): ?>

						<div class="medium-4 columns case-item">

							<a href="<?php echo get_permalink($case); ?>" class="item-inner">

								<?php if($image = wp_get_attachment_image_src(get_post_thumbnail_id($case), 'large' )): ?>

									<div class="item-image" style="background-image: url(<?php echo $image[0]; ?>)"></div>

								<?php endif; ?>

								<div class="item-text">

									<?php $cats = wp_get_post_terms($case, 'case_cat'); ?>

									<span class="cat"><?php echo $cats[0]->name; ?></span>

									<h4><?php echo get_the_title($case); ?></h4>

								</div> <!-- /.item-text -->

							</a> <!-- /.item-inner -->

						</div>

				   <?php endforeach;

				else:

					// Find connected pages
					$connected = new WP_Query( array(
						'connected_type' => 'cases_to_services',
						'connected_items' => get_queried_object(),
						'posts_per_page' => 3,
					) );

					// Display connected pages
					if ( $connected->have_posts() ) :
					?>

						<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
		
						  <div class="medium-4 columns case-item">

							<a href="<?php the_permalink(); ?>" class="item-inner">

								<?php if($image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large' )): ?>

									<div class="item-image" style="background-image: url(<?php echo $image[0]; ?>)"></div>

								<?php endif; ?>

								<div class="item-text">

									<?php $cats = wp_get_post_terms($post->ID, 'case_cat'); ?>

									<span class="cat"><?php echo $cats[0]->name; ?><span>

									<p class="h4"><?php the_title(); ?></p>

								</div> <!-- /.item-text -->

							</a> <!-- /.item-inner -->

						</div>
						
						<?php endwhile; ?>

						<?php wp_reset_postdata();

					endif;

				endif; ?>

			</div>

		</div> <!-- /.row -->

	</section>

<?php endif; ?>

<?php wp_reset_query(); ?>

<?php get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>