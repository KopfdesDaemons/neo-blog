<?php
function custom_theme_pages($wp_customize)
{
    // Sektionen
    $wp_customize->add_section('custom_theme_pages', array(
        'title' => __('Pages', 'my-theme'),
        'priority' => 30,
    ));

    // Optionen ######################################################################

    // Sidebar
    $wp_customize->add_setting('pages_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('pages_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show Sidebar', 'my-theme'),
        'section' => 'custom_theme_pages',
    ));
}
add_action('customize_register', 'custom_theme_pages');
