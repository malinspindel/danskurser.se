<?php
get_header();
?>


<?php if(get_field('top_section_type') == 'slider'): ?>
	<?php get_template_part('templates/backgroundslider'); ?>
<?php endif; ?>

<!--search-filter templtepart-->
<?php get_template_part('templates/search-filter'); ?>
<section class="front-content">
	<h1></h1>
</section>

<?php

$args = array(
  'post_type' => 'danskurser'
);
$the_query = new WP_Query( $args );
$post_count = $the_query->found_posts;

?>
<!--OLD-->
	<main role="main">
		<!-- section -->
		<section>

<h2> Kurser just nu: <?php echo $post_count ; ?> </h2>
			<!-- <h1><?php the_title(); ?></h1> -->
		<i class="fa fa-road"></i> MÅL
		<i class="fa fa-paper-plane-o"></i> DELA DIN KURSER HÄR

		<i class="fa fa-calendar"></i> DAG
		<i class="fa fa-clock-o"></i> TID
		<i class="fa fa-compass"></i> ORT
		<i class="fa fa-star"></i> NIVÅ
		<i class="fa fa-heart-o"></i> ÅLDER
		<i class="fa fa-tags"></i> STILAR

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<!-- <?php comments_template( '', true ); // Remove if you don't want comments ?> -->

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

<!-- <?php get_sidebar(); ?> -->

<?php get_footer(); ?>
