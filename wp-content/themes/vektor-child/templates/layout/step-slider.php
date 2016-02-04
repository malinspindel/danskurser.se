<?php if($slides = get_field('slides', 'options')): ?>

    <section class="layout layout-<?php echo get_row_layout(); ?> space">

        <div class="row">

            <?php if($title = get_field('slider_title', 'options')): ?>

                <div class="medium-12 columns">

                   <h3><?php echo $title; ?></h3>

                </div> <!-- /.medium-12 -->

            <?php endif; ?>

            <div class="medium-12 columns slick-slider">

                <?php while(have_rows('slides', 'options')): the_row(); ?>

                    <div class="slide medium-12">

                        <?php
                        $image = get_sub_field('image', 'options');
                        if($image):
                        ?>
                            <?php $image_src = wp_get_attachment_image_src($image['id'], 'square-small'); ?>

                            <img src="<?php echo $image_src[0]; ?>" alt="<?php echo $image['title']; ?>" />

                        <?php endif; ?>

                        <div class="slider-text">
                            <?php echo strip_tags(get_sub_field('text', 'options'), '<em><strong><li><ol><ul><span>'); ?>
                        </div>

                    </div>

                <?php endwhile; ?>

            </div>

        </div> <!-- /.row -->

    </section>

<?php endif; ?>
