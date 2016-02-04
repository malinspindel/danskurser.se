<div class="small-12 medium-6 large-4 columns isotope-item">
	
	<article class="article">

		<a href="<?php the_permalink(); ?>">

			<?php if($image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'square-small' )): ?>

				<div class="article-img" style="background-image: url(<?php echo $image[0]; ?>)"></div>

			<?php endif; ?>

			<div class="article-text">

				<h2 class="h5"><?php the_title(); ?></h2>

				<div class="entry-content">

					<small><?php echo get_the_excerpt(); ?></small>

				</div> <!-- /.entry-content -->

			</div> <!-- /.article-text -->

			<div class="article-footer">

				<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y M d'); ?></time>

				<?php if($category = get_the_category()): ?>

					<div class="category">

						<?php echo $category[0]->cat_name; ?>

					</div>

				<?php endif; ?>

			</div>

		</a>

	</article>

</div> <!-- /.large-4 -->