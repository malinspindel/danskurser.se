<?php
/*
 * Template Name: Undermeny
 */

$class = array();

if(get_the_vektor_menu()){
	$class['content'] = "medium-8 large-7";
	$class['sidebar'] = "medium-4 large-4 large-offset-1";
} else {
	$class['content'] = "medium-12";
	$class['sidebar'] = "";
}

?>

<?php get_header(); ?>

<?php get_template_part('templates/top-section'); ?>

<?php the_post(); ?>

<section class="space small page-section layout">

	<div class="row">

		<article class="<?php echo $class['content']; ?> columns page-content">

			<div class="entry-content">

				<?php the_content(); ?>

			</div> <!-- /.entry-content -->

		</article> <!-- /.<?php echo $class['content']; ?> -->

		<?php if(get_the_vektor_menu()): ?>

			<aside class="<?php echo $class['sidebar']; ?> columns sidebar">

				<nav>

					<?php the_vektor_menu(); ?>

				 </nav>

			</aside> <!-- /.<?php echo $class['sidebar']; ?> -->

		<?php endif; ?>

	</div> <!-- /.row -->

</section>

<?php get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>