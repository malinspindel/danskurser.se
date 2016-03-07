<section class="top-section text-center">


			<?php while(have_rows('slides')): the_row(); ?>
				<?php
				$image = get_sub_field('bg_image');
				if($image):
				?>
					<?php $image_src = wp_get_attachment_image_src($image['id'], ''); ?>

					<!-- <img src="<?php //echo $image_src[0]; ?>" alt="<?php //echo $image['title']; ?>" /> -->

				<?php endif; ?>
				<div class="slide" style="background-image: url( <?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>)">




					<div class="row">

						<div class="top-inner-row">
			
							<?php if($title = get_sub_field('top_title')): ?>
								<h1><?php echo $title; ?></h1>
							<?php endif; ?>

							<?php if($intro = get_sub_field('top_intro')): ?>
								<h2 class="h5 intro"><?php echo $intro; ?></p>
							<?php endif; ?>

							<?php if($btn_text = get_sub_field('btn_text')): ?>
								<a href="<?php the_sub_field('btn_link_url'); ?>" class="btn"><?php echo $btn_text; ?></a>
							<?php endif; ?>
						</div>
							</div>
					</div>


			<?php endwhile; ?>

	<?php if(get_field('news_slider')): ?>
		<?php get_template_part('templates/news-slider'); ?>
	<?php endif; ?>

</section>
