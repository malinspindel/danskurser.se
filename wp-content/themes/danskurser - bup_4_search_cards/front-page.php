<?php
get_header();
?>


<?php if(get_field('top_section_type') == 'slider'): ?>
	<?php get_template_part('templates/backgroundslider'); ?>
<?php endif; ?>

<!--search-filter templtepart-->
<?php get_template_part('templates/search-filter'); ?>


<!--OLD-->
	<main role="main">
		<!-- section -->
		<section>
HEEEJ FRONT PAGE
			<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

			</article>


			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
