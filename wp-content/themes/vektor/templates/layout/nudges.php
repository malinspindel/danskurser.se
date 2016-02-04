<?php if($nudges = get_sub_field('nudges')): ?>

	<?php
	$nudges_count = count($nudges);
	$column_width = "4";

	if($nudges_count == 2 || $nudges_count == 4)
		$column_width = "6";

	if($nudges_count == 1)
		$column_width = "12 single-nudge";
	?>

	<section class="layout layout-<?php echo get_row_layout(); ?> space text-center">

		<div class="row">

			<?php if($title = get_sub_field('title')): ?>

				<div class="medium-12 columns">

					<h3 class="h2"><?php echo $title; ?></h3>

					</div> <!-- /.medium-12 -->

				<?php endif; ?>

				<?php while(have_rows('nudges')): the_row(); ?>

					<div class="medium-<?php echo $column_width; ?> columns nudge-item">

						<div class="item-inner">

								<?php if($link_url = get_sub_field('link_url')): ?>
								<a href="<?php echo $link_url; ?>">
								<?php endif; ?>

									<?php
									$image = get_sub_field('image');
									if($image):
									?>
									<?php $image_src = wp_get_attachment_image_src($image['id'], 'square-small'); ?>

									<img src="<?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>" />

									<?php endif; ?>

									<h2 class="h5"><?php the_sub_field('title'); ?></h2>

									<small><?php the_sub_field('text'); ?>

										<?php if(get_sub_field('link_url')): ?>

											<span class="a"><?php _e('Read more', 'vektor'); ?></span>

										<?php endif; ?>

									</small>

								<?php if($link_url): ?>
								</a>
								<?php endif; ?>

						</div> <!-- /.item-inner -->

					</div>

				<?php endwhile; ?>

				<?php if($link_text = get_sub_field('btn_text')): ?>

					<div class="medium-12 columns nudge-btn">

						<a class="btn" href="<?php the_sub_field('btn_url'); ?>"><?php echo $link_text; ?></a>

					</div> <!-- /.medium-12 -->

				<?php endif; ?>

		</div> <!-- /.row -->

	</section>

<?php endif; ?>
