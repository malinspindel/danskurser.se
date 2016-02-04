<?php if(function_exists('have_rows') && have_rows('flexible_content')): ?>

	<?php while(have_rows('flexible_content')): the_row(); ?>
		
		 <?php if(get_row_layout() == 'content'): ?>
		 
			  <?php get_template_part('templates/layout/content'); ?>
		
		<?php elseif(get_row_layout() == 'parallax'): ?>
		
			<?php get_template_part('templates/layout/parallax'); ?>

		<?php elseif(get_row_layout() == 'nudges'): ?>

			<?php get_template_part('templates/layout/nudges'); ?>

		<?php elseif(get_row_layout() == 'cases'): ?>

			<?php get_template_part('templates/layout/cases'); ?>

		<?php elseif(get_row_layout() == 'slideshow'): ?>

			<?php get_template_part('templates/layout/slideshow'); ?>

		<?php elseif(get_row_layout() == 'employees'): ?>

			<?php get_template_part('templates/layout/employees'); ?>
		
		<?php endif; ?>

	<?php endwhile; ?>

<?php endif; ?>