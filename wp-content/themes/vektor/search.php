<?php get_header(); ?>

    <div class="row">

        <div class="medium-12 columns">

            <h1><?php vektor_title(); ?></h1>

	        <?php if(have_posts()): ?>

				<?php while (have_posts()) : the_post(); ?>
				
					<article class="article">

                        <?php if($image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'square-small' )): ?>

                             <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />

                        <?php endif; ?>

                        <div class="article-text">

                            <time datetime="<?php the_date(); ?>"><?php echo get_the_date('Y/m/d'); ?></time>

                            <?php if($category = get_the_category()): ?>

                                <div class="category">

                                    <?php echo $category[0]->cat_name; ?>

                                </div>

                            <?php endif; ?>

                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                            <div class="entry-content">

                                <?php the_excerpt(); ?>

                            </div> <!-- /.entry-content -->

						</div> <!-- /.article-text -->
						
					</article>
				
				<?php endwhile; ?>

	        <?php endif; ?>

            <?php get_template_part('templates/pagination'); ?>

        </div> <!-- /.medium-12 -->

    </div> <!-- /.row -->

<?php get_footer(); ?>