<?php get_header(); ?>

<?php the_post(); ?>

<?php get_template_part('templates/top-section'); ?>

	<section class="single-post-section space small layout">

		<div class="row">

			<article class="medium-8 large-7 columns">

				<div class="entry-content">

					<?php the_content(); ?>

				</div> <!-- /.entry-content -->

			</article>

			<aside class="columns medium-4 large-4 large-offset-1 sidebar">

				<?php get_template_part('templates/layout/social'); ?>

				<aside class="aside-list info">
					<span class="h6"><?php _e('Published', 'vektor'); ?></span>
					<small>
						<i class="fa fa-clock-o"></i>
						<time datetime="<?php the_date('Y-m-d'); ?>"><?php echo get_the_date('d M Y'); ?></time>
					</small>
				</aside>
				
				<?php if($category = get_the_category()): ?>
				<aside class="aside-list info">
					<span class="h6"><?php _e('Category', 'vektor'); ?></span>
					<small>
						<i class="fa fa-tag"></i>
						<a href="<?php echo get_category_link($category[0]->term_id); ?>"><?php echo $category[0]->cat_name; ?></a>	
					</small>
				</aside>
				<?php endif; ?>
				
			</aside>

		</div> <!-- /.row -->

	</section>

<?php wp_reset_query(); get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>