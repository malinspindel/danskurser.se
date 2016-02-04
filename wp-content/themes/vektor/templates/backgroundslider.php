<section id="section-slider" class="top-section text-center">

	<div class="superslides">

		<div class="slides-container">

			<?php while(have_rows('slides')): the_row(); ?>
				<div class="slide">
					<?php
					$image = get_sub_field('bg_image');
					if($image):
					?>
						<?php $image_src = wp_get_attachment_image_src($image['id'], ''); ?>

						<img src="<?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>" />

					<?php endif; ?>

					<div class="slides-content table">

						<div class="table-cell align-middle">

							<div class="row">

							<?php if($title = get_sub_field('top_title')): ?>
								<h1><?php echo $title; ?></h1>
							<?php endif; ?>

							<?php if($intro = get_sub_field('top_intro')): ?>
								<p class="intro"><?php echo $intro; ?></p>
							<?php endif; ?>

							<?php if($btn_text = get_sub_field('btn_text')): ?>
								<a href="<?php the_sub_field('btn_link_url'); ?>" class="btn"><?php echo $btn_text; ?></a>
							<?php endif; ?>

							</div>
							
							<div class="scroll-to-next"></div>

						</div> <!-- /.table-cell -->

					</div>

				</div>

			<?php endwhile; ?>

		</div>

	</div>

	<?php if(get_field('news_slider')): ?>
		<?php get_template_part('templates/news-slider'); ?>
	<?php endif; ?>

</section>