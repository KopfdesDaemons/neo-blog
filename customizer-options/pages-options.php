<?php
function neo_blog_custom_pages($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_pages', array(
        'title' => __('Pages', 'neo-blog'),
        'priority' => 30,
        'description' => __('Options for WordPress "Pages".', 'neo-blog'),
    ));

    // Maximum width of the post
    $wp_customize->add_setting('maximum_width_of_pages', array(
        'default' => '70',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('maximum_width_of_pages', array(
        'type' => 'range',
        'label' => __('Maximum width of pages', 'neo-blog'),
        'section' => 'custom_theme_pages',
        'input_attrs' => array(
            'min' => 50,
            'max' => 150,
            'step' => 1,
        ),
    ));

    // Sidebar
    $wp_customize->add_setting('pages_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('pages_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show Sidebar', 'neo-blog'),
        'section' => 'custom_theme_pages',
    ));

    // Text Alignment Option
    $wp_customize->add_setting('page_title_alignment', array(
        'default' => 'left',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('page_title_alignment', array(
        'type' => 'select',
        'section' => 'custom_theme_pages',
        'label' => __('Page Title Alignment', 'neo-blog'),
        'choices' => array(
            'left' => __('left', 'neo-blog'),
            'center' => __('center', 'neo-blog'),
            'right' => __('right', 'neo-blog'),
        ),
    ));

    // Background color
    $wp_customize->add_setting('background_color_pages', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pages_background_color', array(
        'label' => __('Background color light mode', 'neo-blog'),
        'section' => 'custom_theme_pages',
        'settings' => 'background_color_pages'
    )));

    // Background color darkmode
    $wp_customize->add_setting('dark_mode_background_color_pages', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pages_background_color_dark_mode', array(
        'label' => __('Background color dark mode', 'neo-blog'),
        'section' => 'custom_theme_pages',
        'settings' => 'dark_mode_background_color_pages'
    )));
}
add_action('customize_register', 'neo_blog_custom_pages');
