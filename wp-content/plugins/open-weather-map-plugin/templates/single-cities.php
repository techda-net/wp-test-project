<?php
/**
 * Template for cities single
 */
get_header();
?>
<main id="site-content">
    <div class="entry-content">
        <h1><?php echo $post->post_title; ?></h1>
        <p>Zip: <?php echo get_field('field_zip');?>, Latitude: <?php echo get_field('field_latitude');?>, Longitude: <?php echo get_field('field_longitude');?></p>
        <p><?php echo OpenWeatherMapApi::get_data_from_owm(get_field('field_latitude'),get_field('field_longitude'))?></p>
    </div>
</main>

<?php get_footer(); ?>
