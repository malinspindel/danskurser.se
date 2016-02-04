<section class="layout layout-<?php echo get_row_layout(); ?> space">

	<div class="row">

		<div class="medium-12 columns">

			<?php if($title = get_sub_field('title')): ?>

				<h2><?php echo $title; ?></h2>

			<?php endif; ?>

			<?php if($content = get_sub_field('content')): ?>

				<?php echo $content; ?>

			<?php endif; ?>

		</div> <!-- /.medium-12 -->

	</div> <!-- /.row -->


</section>
