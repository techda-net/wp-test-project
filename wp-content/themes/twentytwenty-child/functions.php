<?php

/**
 * Theme functions
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

function twentytweny_child_enqueue_scripts()
{
    //enqueue parent theme style
    wp_enqueue_style(
        'twentytwenty-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    //enqueue child theme style
    wp_enqueue_style(
    'twentytwenty-child-style',
    get_stylesheet_directory_uri().'/style.css'
    );
}

add_action('wp_enqueue_scripts', 'twentytweny_child_enqueue_scripts');