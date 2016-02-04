<?php if($employees = get_sub_field('employees')): ?>

	<?php
	$employees_count = count($employees);
	$column_width = "3 medium-4";

	if($employees_count == 3 || $employees_count == 6)
		$column_width = "4";
	?>

	<section class="layout layout-<?php echo get_row_layout(); ?> space">

		<div class="row">

			<?php if($title = get_sub_field('title')): ?>

				<div class="medium-12 columns">

				   <h3><?php echo $title; ?></h3>

				</div> <!-- /.medium-12 -->

			<?php endif; ?>

			<?php foreach($employees as $employee): ?>

				<div class="large-<?php echo $column_width; ?> columns employee-item">

					<div class="item-inner">

						<?php if($image = wp_get_attachment_image_src(get_post_thumbnail_id($employee), 'large' )): ?>

							<div class="item-image" style="background-image: url(<?php echo $image[0]; ?>)"></div>

						<?php endif; ?>

						<div class="item-text">

							<h5><?php echo get_the_title($employee); ?></h5>
							<?php if($work = get_field('work', $employee)): ?>
								<span class="h6 work"><?php echo $work; ?></span>
							<?php endif; ?>

							<ul>
								<?php if($email = get_field('email', $employee)): ?>
									<li><a class="email" href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a></li>
								<?php endif; ?>

								<?php if($phone = get_field('phone', $employee)): ?>
									<li><a class="phone" href="tel:<?php echo preg_replace("/[^0-9]/","",$phone); ?>"><?php echo $phone; ?></a></li>									
								<?php endif; ?>

							</ul>

						</div> <!-- /.item-text -->

					</div> <!-- /.item-inner -->

				</div>

			<?php endforeach; ?>

		</div> <!-- /.row -->

	</section>

<?php endif; ?>
