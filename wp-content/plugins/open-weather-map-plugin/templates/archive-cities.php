<?php
/**
 * Template for citites Archive
 */
get_header();
?>
    <main id="site-content">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                echo '<div class="entry-content">';
                echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
                echo '</div>';
            endwhile;
        endif;
        ?>
    </main>
<?php
get_footer();