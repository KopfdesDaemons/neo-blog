<?php
function neo_custom_pages($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_pages', array(
        'title' => __('Pages', 'neo'),
        'priority' => 30,
        'description' => __('Options for WordPress "Pages".', 'neo'),
    ));

    // Sidebar
    $wp_customize->add_setting('pages_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('pages_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show Sidebar', 'neo'),
        'section' => 'custom_theme_pages',
    ));
}
add_action('customize_register', 'neo_custom_pages');
