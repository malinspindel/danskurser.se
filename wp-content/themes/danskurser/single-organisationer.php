<?php get_header(); ?>


<section class="first-content row">

	<div class="small-12 medium-12 large-12 padding-sides padding-top-bottom columns">

    <img class="org-img" src="<?php the_field(logotype); ?>">

        <p>
        <strong>Organisation: </strong><?php the_field(org_name); ?><br>
        <strong>Hemsida: </strong><a href="<?php the_field(org_webpage_link); ?>">Besök <?php the_field(org_name); ?> här. </a><br>

        <strong>Organisationsnummer: </strong></strong><?php the_field(org_nr); ?><br>
        <strong>Telefon: </strong></strong><?php the_field(tele); ?><br>
        <strong>E-post: </strong></strong><?php the_field(mail); ?>
        </p>
        <p>
        <strong>Besöksadress: </strong><?php the_field(address); ?>
        </p>

	</div>

</section> <!-- /section -->

<section class="google-map">

    <?php

    $location = get_field('org_map');

    if( !empty($location) ):
    ?>
    <div class="acf-map">
    	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div>
    <?php endif; ?>


</section>


<?php get_footer(); ?>
