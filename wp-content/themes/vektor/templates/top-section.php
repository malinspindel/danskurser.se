<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), '' ); ?>
<section class="top-section space" <?php if($image): ?>style="background-image: url(<?php echo $image[0]; ?>)"<?php endif; ?>>

	<div class="table">

		<div class="table-cell align-middle">

			<div class="row">

				<div class="columns medium-12 large-10 large-centered text-center">

					<?php if($title = get_field('title')): ?>
					
						<h1><?php echo $title; ?></h1>
						
					<?php else: ?>
					
						<h1><?php vektor_title(); ?></h1>
						
					<?php endif; ?>

					<?php if($intro = get_field('intro')): ?>

						<p class="intro"><?php echo $intro; ?></p>

					<?php endif; ?>

				</div> <!-- /.medium-12 -->

			</div>

		</div>

	</div>

</section>

