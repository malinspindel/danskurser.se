<?php

	$image = get_sub_field('image');
	$image_desktop = wp_get_attachment_image_src($image['id'], 'thumb-parallax-screen');
	$image_mobile = wp_get_attachment_image_src($image['id'], 'thumb-parallax-mobile');

?>

<section class="layout layout-<?php echo get_row_layout(); ?>">
	
	<div class="parallax-image" data-image="<?php echo $image_desktop[0]; ?>" data-image-mobile="<?php echo $image_mobile[0]; ?>" data-width="<?php echo $image_desktop[1]; ?>" data-height="<?php echo $image_desktop[2]; ?>"></div>
	
	<div class="parallax-content">
		
		<div class="table">
			
			<div class="table-cell align-middle">
			
				<div class="row">
				<div class="medium-12 large-10 large-centered columns text-center">
				
				<?php if($title = get_sub_field('title')): ?>

					<h2 class="h3"><?php echo $title; ?></h2>
				
				<?php endif; ?>

				<?php if($text = get_sub_field('text')): ?>

					<p class="intro"><?php echo $text; ?></p>

				<?php endif; ?>

				<?php if($link = get_sub_field('btn_link_url')): ?>

					<a href="<?php echo $link; ?>" class="btn"><?php the_sub_field('btn_text'); ?></a>

				<?php endif; ?>
				
				</div>
				</div>
				
			</div> <!-- /.table-cell -->
	
		</div> <!-- /.table -->
	
	</div> <!-- /.parallax-content -->

</section>