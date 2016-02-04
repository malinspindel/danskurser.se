<?php
/*
 * Custom Books Page Template
 */

get_header();
?>


	<?php if(get_field('top_section_type') == 'video'): ?>
		<?php get_template_part('templates/backgroundvideo'); ?>
	<?php else: ?>
		<?php get_template_part('templates/backgroundslider'); ?>
	<?php endif; ?>

  <section id="primary" class="content-area">
  (Id primary class content-area)
      <div id="content" class="site-content" role="main">
  			(id="content" class="site-content")
  			<h1>Tutorial section 2</h1>
      <?php
      if( have_posts() ):
          while( have_posts() ): the_post();
              get_template_part('content');
          endwhile;
      endif;
      ?>
      </div>
  </section>

  <div id="genre-filter">
    Calling the genre_filters function:
    <?php echo get_genre_filters(); ?>
  </div>

  <div class="entry-content">
    genre search:
    <form id="genre-search">
        <input type="text" class="text-search" placeholder="Search books..." />
        <input type="submit" value="Search" id="submit-search" />
    </form>
    <div id="genre-filter">
        <?php echo get_genre_filters(); ?>
    </div>
    <div id="genre-results"></div>
</div>





<?php get_template_part('templates/news-slider'); ?>

	<?php get_template_part('templates/flexible-content'); ?>

<?php get_footer(); ?>
