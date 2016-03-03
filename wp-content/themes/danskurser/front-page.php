

<?php
get_header();
?>


<?php if(get_field('top_section_type') == 'slider'): ?>
	<?php get_template_part('templates/backgroundslider'); ?>
<?php endif; ?>

<!--search-filter templtepart-->
<?php get_template_part('templates/search-filter'); ?>

<?php

$args = array(
  'post_type' => 'danskurser'
);
$the_query = new WP_Query( $args );
$post_count_courses = $the_query->found_posts;

$args = array(
  'post_type' => 'organisationer'
);
$the_query = new WP_Query( $args );
$post_count_org = $the_query->found_posts;

?>
<div class="row full-width-row">
	<div class="text-slider-wrapper">
		<section class="row text-slider">
			<?php echo do_shortcode( '[content-text-slider setting="1" group="1"]' ); ?>
		</section>
	</div>
</div>
<div class="row full-width-row row-wrapper">


	<section class="row front-page-content">

		<article class="columns small-12 medium-4 large-4 text-right padding-top-bottom">
			<div class="container content-left">
				<?php the_content(); ?>
			</div>

</article>

		<article class="columns small-12 medium-4 large-4 text-center padding-top-bottom">
			<div class="container content-center padding-top-bottom">
				<h2 class="count-courses"><?php echo $post_count_courses ; ?> </h2>
				<p class="first-p"><span class="letter-spacing"> PUBLICERADE </span><span class="accent-text">KURSER</span></p>
				<p class="second-p"><span class="letter-spacing">ANSLUTNA</span><br><span class="accent-text">ORGANIS<br>ATIONER</span></p>
				<h2 class="count-org"><?php echo $post_count_org ; ?> </h2>

			</div>
		</article>

		<article class="columns small-12 medium-4 large-4 padding-top-bottom">
			<div class="container content-right">
				<?php if(have_rows('flexible_content')): the_row(); ?>
					<?php if(get_row_layout() == 'content'): ?>

						<?php if($title = get_sub_field('title')): ?>
							<h2><?php echo $title; ?></h2>
						<?php endif; ?>

						<?php if($content = get_sub_field('content')): ?>
							<?php echo $content; ?>
						<?php endif; ?>

					<?php endif; ?>
				<?php endif; ?>
			</div>
		</article>


		<div id="here">

		</div>


	</section>
</div><!--// row-wrapper-->



<?php get_footer(); ?>
