<?php

/*
 * Template Name: Tjänster
 */

?>

<?php get_header(); ?>

<?php get_template_part('templates/top-section'); ?>

<?php $current = $post->ID; ?>

<?php
	$wp_query = new WP_Query(
		array(
			'post_type' => 'service',
			'posts_per_page' => -1
		)
	);
?>

<?php if($wp_query->have_posts()): ?>

	<section class="services-section space small layout">

		<div class="row">

			<div class="medium-12 large-9 services-wrapper">

				<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

					<div class="columns medium-12 one-service">

						<div class="item-inner">

							<?php
							$image = get_post_thumbnail_id();
							if($image):
							?>
								<?php $image_src = wp_get_attachment_image_src($image, 'square-small'); ?>
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo $image_src[0]; ?>" alt="<?php the_title(); ?>" />
								</a>

							<?php endif; ?>

							<h2 class="h3"><?php the_title(); ?></h2>

							<?php the_excerpt(); ?>

							<a class="btn btn-small" href="<?php the_permalink(); ?>"><?php _e('Read more', 'vektor'); ?></a>

						</div> <!-- /.item-inner -->

					</div>

				<?php endwhile; wp_reset_postdata(); ?>

			</div>

			<!--<aside class="columns medium-4 sidebar">

				<nav>

					<ul class="service-list">

						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

							<li<?php if($current == $post->ID): ?> class="current_page_item"<?php endif; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

						<?php endwhile; ?>

					</ul>

				</nav>

			</aside>-->

			<div class="medium-12 columns">

				<?php get_template_part('templates/pagination'); ?>

				<?php wp_reset_query(); ?>

			</div> <!-- /.medium-12 -->

		</div> <!-- /.row -->

	</section>

<?php endif; ?>

<?php wp_reset_query(); get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>