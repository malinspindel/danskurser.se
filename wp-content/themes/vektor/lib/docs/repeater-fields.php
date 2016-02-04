<?php
	/*
	 * ACF Repeater Fields
	 * http://www.advancedcustomfields.com/resources/repeater/
	 */
?>

<?php if(have_rows('repeater_field_name')): ?>

	<?php while(have_rows('repeater_field_name')): the_row(); ?>

		<?php the_sub_field('sub_field_name'); ?>

	<?php endwhile; ?>

<?php endif; ?>