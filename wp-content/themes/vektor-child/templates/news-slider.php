<div class="news-slider-section">
	
	<div class="news-slider">

		<?php
			$wp_query = new WP_Query(
				array(
					'posts_per_page' => 6
				)
			);
		?>
		
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			
			<?php $category = get_the_category(); ?>
	
			<div class="news-item">
				
				<a class="news-item-container"	href="<?php the_permalink(); ?>">
					
					<p class="news-cat"><?php echo get_the_date('Y m d') . " / " . $category[0]->cat_name; ?></p>
					
					<h4 class="h4 news-title"><?php the_title(); ?></h4>
					<p class="news-text">
						<?php
							$the_content = get_the_content();
							$the_content = strip_tags($the_content);
							$the_content = substr($the_content, 0, 220);
							
						?>
						<?php echo $the_content . "..."; ?>
					</p>
					
				</a>
				
			</div> <!-- /.news-item -->

		<?php endwhile; ?>
		
		<?php wp_reset_query(); ?>

	</div> <!-- /.news-slider -->
	
</div> <!-- /.news-slider-section -->