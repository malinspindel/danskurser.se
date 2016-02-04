<?php
	/*
	 * WordPress WP_Query
	 * http://codex.wordpress.org/Class_Reference/WP_Query
	 */
?>

<?php
	$the_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => 10
		)
	);
?>

<?php if($the_query->have_posts()): ?>

	<?php while($the_query->have_posts()): $the_query->the_post(); ?>

		<?php the_title(); ?>

		<?php the_excerpt(); ?>

	<?php endwhile; ?>

	<?php wp_reset_query(); ?>

<?php endif; ?>