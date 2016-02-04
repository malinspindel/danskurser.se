<?php

/*
 * Template Name: Nyheter
 */

?>

<?php get_header(); ?>

<?php
$page_for_posts = get_option('page_for_posts');
$post = get_post($page_for_posts);
setup_postdata($post);

get_template_part('templates/top-section');

wp_reset_postdata();

$posts_per_page = get_option('posts_per_page');
?>

	
	<?php
		$wp_query = new WP_Query(
			array(
				'post_type' => 'post',
				'posts_per_page' => $posts_per_page
			)
		);
	?>

	<?php if($wp_query->have_posts()): ?>

	<section class="news-section space small layout" data-amount="<?php echo $posts_per_page; ?>">

			<div class="row">
				
				<div class="isotope-container">
				
				<?php while (have_posts()) : the_post(); ?>

					<?php get_template_part('templates/news-article'); ?>

				<?php endwhile; ?>
				
				</div>

			</div> <!-- /.row -->

			<div class="row text-center">

				<?php $args = array(
					'offset' => $posts_per_page,
					'posts_per_page' => $posts_per_page
				);
				$posts_query = new WP_Query( $args );
				if ($posts_query->have_posts()): ?>
					<a class="load_more btn " data-nonce="<?php echo wp_create_nonce('load_posts') ?>"
					href="javascript:;"><span class="btn-text"><?php _e('Load more posts', 'vektor'); ?></span> <i class="fa fa-plus"></i></a>
				<?php endif;
				?>

			</div>

		</section>
		
	<?php endif; ?>

	<?php get_template_part('templates/flexible-content'); ?>
	
<?php get_footer(); ?>