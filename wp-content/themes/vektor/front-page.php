<?php get_header(); ?>
	
	<?php if(get_field('top_section_type') == 'video'): ?>
		<?php get_template_part('templates/backgroundvideo'); ?>
	<?php else: ?>
		<?php get_template_part('templates/backgroundslider'); ?>
	<?php endif; ?>

	<?php get_template_part('templates/flexible-content'); ?>
	
<?php get_footer(); ?>