<?php
	/*
	 * ACF Flexible Content Fields
	 * http://www.advancedcustomfields.com/resources/flexible-content/
	 */
?>

<?php if(have_rows('flexible_content_field')): ?>

	<?php while(have_rows('flexible_content_field')): the_row(); ?>
		
		 <?php if(get_row_layout() == 'layout_first'): ?>
	    
	         <?php // Do some stuff here ?>
		
		<?php elseif(get_row_layout() == 'layout_second'): ?>
		
			<?php // And here ?>
		
		<?php endif; ?>

	<?php endwhile; ?>

<?php endif; ?>