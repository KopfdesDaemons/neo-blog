<?php
function neo_custom_posts($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_article', array(
        'title' => __('Posts', 'neo'),
        'priority' => 30,
        'description' => __('Settings of the individual posts.', 'neo')
    ));

    // Maximum width of the post
    $wp_customize->add_setting('maximum_width_of_posts', array(
        'default' => '70',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('maximum_width_of_posts', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Maximum width of posts', 'neo'),
        'section' => 'custom_theme_article',
        'input_attrs' => array(
            'min' => 50,
            'max' => 150,
            'step' => 1,
        ),
    ));

    // Heading font size
    $wp_customize->add_setting('heading_font_size', array(
        'default' => '24',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('heading_font_size', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Heading font size', 'neo'),
        'section' => 'custom_theme_article',
        'input_attrs' => array(
            'min' => 24,
            'max' => 50,
            'step' => 1,
        ),
        'active_callback' => 'slogan_active_callback'
    ));

    // Text Alignment Option
    $wp_customize->add_setting('posts_title_alignment', array(
        'default' => 'left', // Standardausrichtung auf links
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Hier können Sie weitere Sanitizing-Funktionen hinzufügen, wenn nötig.
    ));

    $wp_customize->add_control('posts_title_alignment', array(
        'type' => 'select',
        'section' => 'custom_theme_article',
        'label' => __('Page Title Alignment', 'neo'),
        'choices' => array(
            'left' => __('left', 'neo'),
            'center' => __('center', 'neo'),
            'right' => __('right', 'neo'),
        ),
    ));

    // Background color
    $wp_customize->add_setting('background_color_posts', array(
        'default' => '#0A0A0A00',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Posts_background_color', array(
        'label' => __('Background color light mode', 'neo'),
        'section' => 'custom_theme_article',
        'settings' => 'background_color_posts'
    )));

    // Background color darkmode
    $wp_customize->add_setting('dark_mode_background_color_posts', array(
        'default' => '#0A0A0A00',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Post_background_color_dark_mode', array(
        'label' => __('Background color dark mode', 'neo'),
        'section' => 'custom_theme_article',
        'settings' => 'dark_mode_background_color_posts'
    )));

    // Date
    $wp_customize->add_setting('post_date', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_date', array(
        'type' => 'checkbox',
        'label' => __('Show date', 'neo'),
        'section' => 'custom_theme_article',
    ));

    // Categories
    $wp_customize->add_setting('post_categories', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_categories', array(
        'type' => 'checkbox',
        'label' => __('Show categories', 'neo'),
        'section' => 'custom_theme_article',
    ));

    // Tags
    $wp_customize->add_setting('tags', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('tags', array(
        'type' => 'checkbox',
        'label' => __('Show tags', 'neo'),
        'section' => 'custom_theme_article',
    ));

    // Author details
    $wp_customize->add_setting('author_details', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_details', array(
        'type' => 'checkbox',
        'label' => __('Show author details', 'neo'),
        'section' => 'custom_theme_article',
    ));

    // Pagination
    $wp_customize->add_setting('post_pagination', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_pagination', array(
        'type' => 'checkbox',
        'label' => __('Show post pagination', 'neo'),
        'section' => 'custom_theme_article',
    ));

    // Sidebar
    $wp_customize->add_setting('post_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show sidebar', 'neo'),
        'section' => 'custom_theme_article',
    ));
}
add_action('customize_register', 'neo_custom_posts');
