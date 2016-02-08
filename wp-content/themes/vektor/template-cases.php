<?php

/*
 * Template Name: Case
 */

?>

<?php get_header(); ?>

<?php get_template_part('templates/top-section'); ?>

	<?php
		$wp_query = new WP_Query(
			array(
				'post_type' => 'case',
				'posts_per_page' => 12,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			)
		);
	?>

	<?php if($wp_query->have_posts()): ?>

		<section class="cases-section space small layout">

		<div class="row">

			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

				  <div class="small-12 medium-6 large-4 columns case-item">

					<a href="<?php the_permalink(); ?>" class="item-inner">

						<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large' ); ?>

						<div class="item-image"<?php if($image): ?> style="background-image: url(<?php echo $image[0]; ?>)"<?php endif; ?>></div>

						<div class="item-text">

							<?php $cats = wp_get_post_terms($post->ID, 'case_cat'); ?>

							<span class="cat"><?php echo $cats[0]->name; ?></span>

							<h4><?php the_title(); ?></h4>

						</div> <!-- /.item-text -->

					</a> <!-- /.item-inner -->

				</div>
			<?php endwhile; ?>

			<div class="medium-12 columns">

				<?php get_template_part('templates/pagination'); ?>

				<?php wp_reset_query(); ?>

			</div> <!-- /.medium-12 -->

		</div> <!-- /.row -->

		</section>

	<?php endif; ?>

	<?php wp_reset_query(); get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>
