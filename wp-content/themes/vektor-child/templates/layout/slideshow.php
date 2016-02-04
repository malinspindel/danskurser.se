<?php if($slideshow = get_sub_field('slideshow')): ?>

	<?php $slideshow_type = get_field('slideshow_type', $slideshow); ?>

	<section class="layout layout-<?php echo get_row_layout(); ?> <?php echo $slideshow_type; ?>-slideshow">

		<div class="row">
		
			<?php
			/*
			* "Så funkar det"
			*/
			?>

			<?php if($slideshow_type == "step"): ?>

				<?php if($title = get_field('slider_title', $slideshow)): ?>

					<div class="medium-12 columns text-center">
						<h3><?php echo $title; ?></h3>
					</div> <!-- /.medium-12 -->

				<?php endif; ?>

				<div class="medium-12 large-10 large-centered columns slick-slider clearfix">

					<?php while(have_rows('slides', $slideshow)): the_row(); ?>

						<div class="slide medium-12">

							<div class="slide-inner table">

								<div class="table-row">

									<div class="table-cell align-middle">

										<?php if($image = get_sub_field('image')): ?>

											<?php $image_src = wp_get_attachment_image_src($image['id'], 'square-small'); ?>
											<img src="<?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>" />

										<?php endif; ?>

									</div>

									<div class="table-cell align-middle">

										<div class="slider-text">
											<?php echo strip_tags(get_sub_field('text'), '<em><strong><li><ol><ul><span>'); ?>
										</div>

									</div>

								</div>

							</div>

						</div>

					<?php endwhile; ?>

				</div>
			
			<?php
			/*
			* Citat
			*/
			?>

			<?php elseif($slideshow_type == "quote"): ?>

				<?php if($title = get_field('slider_title', $slideshow)): ?>

					<div class="medium-12 columns text-center">
						<h3><?php echo $title; ?></h3>
					</div> <!-- /.medium-12 -->

				<?php endif; ?>

				<div class="medium-12 large-10 large-centered columns slick-slider text-center clearfix">
					

					<?php while(have_rows('slides', $slideshow)): the_row(); ?>

						<div class="slide medium-12">

								<div class="slide-inner">

								<?php if($image = get_sub_field('image')): ?>

									<?php $image_src = wp_get_attachment_image_src($image['id'], 'square-small'); ?>
									<img src="<?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>" />

								<?php endif; ?>

								<blockquote class="intro">
									<?php echo strip_tags(get_sub_field('text'), '<em><strong><li><ol><ul><span>'); ?>
								
									<?php if($slideshow_type == "quote"): ?>

										<cite class="quote-person"><?php the_sub_field('person'); ?></cite>

									<?php endif; ?>
								
								</blockquote>

							</div>

						</div>

					<?php endwhile; ?>

				</div>
				
			<?php
			/*
			* Bilder
			*/
			?>
			
			<?php elseif($slideshow_type == "image"): ?>

				<?php if($title = get_field('slider_title', $slideshow)): ?>

					<div class="medium-12 columns">
						<h3><?php echo $title; ?></h3>
					</div> <!-- /.medium-12 -->

				<?php endif; ?>

				<div class="medium-12 columns slick-slider">

					<?php while(have_rows('slides', $slideshow)): the_row(); ?>

						<div class="slide">

							<?php if($image = get_sub_field('image')): ?>

								<?php $image_src = wp_get_attachment_image_src($image['id'], 'large'); ?>
								<img class="slide medium-12" src="<?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>" />

							<?php endif; ?>

						</div>

					<?php endwhile; ?>

				</div>

			<?php
			/*
			* Logotyper
			*/
			?>
			
			<?php elseif($slideshow_type == "logo"): ?>

				<?php if($title = get_field('slider_title', $slideshow)): ?>

					<div class="medium-12 columns text-center">
						<h3><?php echo $title; ?></h3>
					</div> <!-- /.medium-12 -->

				<?php endif; ?>

				<div class="medium-12 columns logo-slider">

					<?php while(have_rows('slides', $slideshow)): the_row(); ?>

						<div class="slide table">
						<div class="table-cell align-middle">

							<?php if($image = get_sub_field('image')): ?>

								<?php $image_src = wp_get_attachment_image_src($image['id'], 'large'); ?>

								<?php if($link_url = get_sub_field('link_url')): ?>
									<a href="<?php echo $link_url; ?>">
								<?php endif; ?>

								<img class="slide medium-12" src="<?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>" />

								<?php if($link_url): ?>
									</a>
								<?php endif; ?>

							<?php endif; ?>

						</div>
						</div>

					<?php endwhile; ?>

				</div>

			<?php endif; ?>


		</div> <!-- /.row -->

	</section>

<?php endif; ?>
