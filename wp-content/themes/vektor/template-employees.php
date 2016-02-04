<?php
/*
 * Template Name: Medarbetare
 */
?>

<?php get_header(); ?>

<?php get_template_part('templates/top-section'); ?>
	
	<?php
		$wp_query = new WP_Query(
			array(
				'post_type' => 'employee',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => -1
			)
		);
	?>

	<?php if($wp_query->have_posts()): ?>

		<section class="employee-section space small layout">

		<div class="row">

			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

				<div class="small-12 medium-4 large-4 columns employee-item">

					<div class="item-inner">

						<?php if($image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large' )): ?>

							<div class="item-image" style="background-image: url(<?php echo $image[0]; ?>)"></div>

						<?php endif; ?>

						<div class="item-text">

							<h5><?php the_title(); ?></h5>
							<?php if($work = get_field('work')): ?>
								<span class="h6 work"><?php echo $work; ?></span>
							<?php endif; ?>
								
							<ul>
								<?php if($email = get_field('email')): ?>
									<li><a class="email" href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a></li>
								<?php endif; ?>

								<?php if($phone = get_field('phone')): ?>
									<li><a class="phone" href="tel:<?php echo preg_replace("/[^0-9]/","",$phone); ?>"><?php echo $phone; ?></a></li>									
								<?php endif; ?>

							</ul>

						</div> <!-- /.item-text -->

					</div> <!-- /.item-inner -->

				</div>

			<?php endwhile; wp_reset_query(); ?>

		</div> <!-- /.row -->

		</section>

	<?php endif; ?>

	<?php get_template_part('templates/flexible-content'); ?>
	
<?php get_footer(); ?>