<?php get_header(); ?>
<section class="first-content row">

	<div class="small-12 medium-12 large-12 padding-sides padding-top-bottom columns">
    <?php echo the_title();

    ?><br>
    <p>

      <img src="<?php the_field(logotype); ?>">
    <?php the_field(org_name); ?><br>

    <?php the_field(org_nr); ?><br>
    <?php the_field(tele); ?><br>
    <?php the_field(mail); ?><br>
    <?php the_field(address); ?><br>
    </p>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</article>

	</div>

</section> <!-- /section -->



<?php get_footer(); ?>
