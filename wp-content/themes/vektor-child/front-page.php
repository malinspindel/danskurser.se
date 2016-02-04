<?php get_header(); ?>

	<?php if(get_field('top_section_type') == 'video'): ?>
		<?php get_template_part('templates/backgroundvideo'); ?>
	<?php else: ?>
		<?php get_template_part('templates/backgroundslider'); ?>
	<?php endif; ?>





<?php get_template_part('templates/news-slider'); ?>

	<?php get_template_part('templates/flexible-content'); ?>

	AJAX SÖKFUNKTION:

		<?php echo do_shortcode('[searchandfilter fields="search,category,post_tag,post_format,taxonomyone,taxonomytwo" types=",radio,checkbox,select,radio,select" hierarchical=",1" headings=",Categories,Tags,Post Format,Taxonomy One,Taxonomy Two, Hej dans" submit_label="Filter"]'); ?>	

<?php get_footer(); ?>
