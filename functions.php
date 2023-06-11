<?php
function enqueue_custom_styles()
{
    wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/styles.css', array(), '1', 'all');
    wp_enqueue_style('searchform-styles', get_stylesheet_directory_uri() . '/searchform.css', array(), '1', 'all');
    wp_enqueue_style('header-styles', get_stylesheet_directory_uri() . '/header.css', array(), '1', 'all');
    wp_enqueue_style('custom-font', get_stylesheet_directory_uri() . '/fonts/fonts.css', array(), '1', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// function themename_custom_logo_setup()
// {
//     $defaults = array(
//         'height'               => 100,
//         'width'                => 400,
//         'flex-height'          => true,
//         'flex-width'           => true,
//         'header-text'          => array('site-title', 'site-description'),
//         'unlink-homepage-logo' => true,
//     );
//     add_theme_support('custom-logo', $defaults);
// }
// add_action('after_setup_theme', 'themename_custom_logo_setup');