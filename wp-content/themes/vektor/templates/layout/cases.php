<?php if($cases = get_sub_field('cases')): ?>

    <?php
    $cases_count = count($cases);
    $column_width = "4";

    if($cases_count == 2 || $cases_count == 4)
        $column_width = "6";
    ?>

    <section class="layout layout-<?php echo get_row_layout(); ?> space">

        <div class="row">

            <?php if($title = get_sub_field('title')): ?>

                <div class="medium-12 large-10 large-centered columns text-center">

                   <h3><?php echo $title; ?></h3>

                </div> <!-- /.medium-12 -->

            <?php endif; ?>

            <?php foreach($cases as $case): ?>

                <div class="medium-<?php echo $column_width; ?> columns case-item">

                    <a href="<?php echo get_permalink($case); ?>" class="item-inner">

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($case), 'large'); ?>

                        <div class="item-image"<?php if($image): ?> style="background-image: url(<?php echo $image[0]; ?>)"<?php endif; ?>></div>

                        <div class="item-text">

                            <?php $cats = wp_get_post_terms($case, 'case_cat'); ?>

                            <span class="cat"><?php echo $cats[0]->name; ?></span>

                            <h4><?php echo get_the_title($case); ?></h4>

                        </div> <!-- /.item-text -->

                    </a> <!-- /.item-inner -->

                </div>

            <?php endforeach; ?>

            <?php if($link_url = get_sub_field('link_url')): ?>

                <div class="medium-12 columns case-btn">

                    <a class="btn" href="<?php echo $link_url; ?>"><?php _e('More cases', 'vektor'); ?></a>

                </div> <!-- /.medium-12 -->

            <?php endif; ?>

        </div> <!-- /.row -->

    </section>

<?php endif; ?>
