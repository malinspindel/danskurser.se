<?php get_header(); ?>

<section class="first-content row">


	<div class="small-12 medium-12 large-12 padding-sides padding-top-bottom columns">
		<h1><?php the_title(); ?></h1>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</article>

	</div>

</section> <!-- /section -->
</main>


<?php get_footer(); ?>
