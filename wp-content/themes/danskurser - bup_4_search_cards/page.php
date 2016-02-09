<?php get_header(); ?>

<section class="row no-padding-side">
	<div class="large-6 columns no-padding-side">

		<?php if($image = wp_get_attachment_image_src(get_post_thumbnail_id($case), 'large' )): ?>
			<img src='<?php echo $image[0]; ?>'>
		<?php endif; ?>


	</div>

	<div class="large-6 padding-sides padding-top-bottom columns">
		<h1><?php the_title(); ?></h1>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</article>


	</div>


</section> <!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
