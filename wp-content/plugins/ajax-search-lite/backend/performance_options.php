<?php
/* Prevent direct access */
defined( 'ABSPATH' ) or die( "You can't access this file directly." );

$cache_options = get_option( 'asl_performance' );
?>
<div id="wpdreams" class='wpdreams wrap'>
    <div class="wpdreams-box">
        <?php ob_start(); ?>
        <div class="item">
            <p class='infoMsg'>Turn it OFF if the search stops working correctly after enabling.</p>
            <?php $o = new wpdreamsYesNo( "use_custom_ajax_handler", "Use custom ajax handler", wpdreams_setval_or_getoption( $cache_options, 'use_custom_ajax_handler', 'asl_performance_def' ) ); ?>
            <p class="descMsg">The queries will be posted to a custom ajax handler file, which does not wait for whole WordPress loading process. Usually it has great performance impact.</p>
        </div>
        <div class="item">
            <?php $o = new wpdreamsYesNo( "image_cropping", "Crop images for caching?",
                wpdreams_setval_or_getoption( $cache_options, 'image_cropping', 'asl_performance_def' ) ); ?>
            <p class="descMsg">When turned OFF, it disables thumbnail generator, and the full sized images are used as cover. Not much difference visually, but saves a lot of CPU.</p>
        </div>
        <div class="item">
            <?php $o = new wpdreamsYesNo( "load_in_footer", "Load JavaScript in site footer?",
                wpdreams_setval_or_getoption( $cache_options, 'load_in_footer', 'asl_performance_def' ) ); ?>
            <p class="descMsg">Will load the JavaScript files in the site footer for better performance.</p>
        </div>
        <div class="item">
            <input type='submit' class='submit' value='Save options'/>
        </div>
        <?php $_r = ob_get_clean(); ?>


        <?php
        $updated = false;
        if ( isset( $_POST ) && isset( $_POST['asl_performance'] ) ) {
            $values = array(
                "use_custom_ajax_handler" => $_POST['use_custom_ajax_handler'],
                "image_cropping"          => $_POST['image_cropping'],
                "load_in_footer"          => $_POST['load_in_footer']
            );
            update_option( 'asl_performance', $values );
            $updated = true;
        }
        ?>

        <div class='wpdreams-slider'>
            <form name='asl_performance_form' method='post'>
                <?php if ( $updated ): ?>
                    <div class='successMsg'>Performance settings successfuly updated!</div><?php endif; ?>
                <fieldset>
                    <legend>Performance Options</legend>
                    <?php print $_r; ?>
                    <input type='hidden' name='asl_performance' value='1'/>
                </fieldset>
            </form>
        </div>

    </div>
</div>