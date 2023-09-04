<?php
function custom_theme_posts($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_article', array(
        'title' => __('Posts', 'my-theme'),
        'priority' => 30,
        'description' => __('Settings of the individual posts.', 'my-theme')
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
        'label' => __('Maximum width of posts', 'my-theme'),
        'section' => 'custom_theme_article',
        'input_attrs' => array(
            'min' => 50,
            'max' => 150,
            'step' => 1,
        ),
    ));

    // Heading font size
    $wp_customize->add_setting('heading_font_size', array(
        'default' => '35',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('heading_font_size', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Heading font size', 'my-theme'),
        'section' => 'custom_theme_article',
        'input_attrs' => array(
            'min' => 24,
            'max' => 50,
            'step' => 1,
        ),
        'active_callback' => 'slogan_active_callback'
    ));

    // Background color
    $wp_customize->add_setting('background_color_posts', array(
        'default' => '#0A0A0A00',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Posts_background_color', array(
        'label' => 'Background color light mode',
        'section' => 'custom_theme_article',
        'settings' => 'background_color_posts'
    )));

    // Background color darkmode
    $wp_customize->add_setting('dark_mode_background_color_posts', array(
        'default' => '#0A0A0A00',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Post_background_color_dark_mode', array(
        'label' => 'Background color dark mode',
        'section' => 'custom_theme_article',
        'settings' => 'dark_mode_background_color_posts'
    )));

    // Date
    $wp_customize->add_setting('post_date', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('post_date', array(
        'type' => 'checkbox',
        'label' => __('Show date', 'my-theme'),
        'section' => 'custom_theme_article',
    ));

    // Categories
    $wp_customize->add_setting('post_categories', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('post_categories', array(
        'type' => 'checkbox',
        'label' => __('Show categories', 'my-theme'),
        'section' => 'custom_theme_article',
    ));

    // Tags
    $wp_customize->add_setting('tags', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('tags', array(
        'type' => 'checkbox',
        'label' => __('Show tags', 'my-theme'),
        'section' => 'custom_theme_article',
    ));

    // Author details
    $wp_customize->add_setting('author_details', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_details', array(
        'type' => 'checkbox',
        'label' => __('Show author details', 'my-theme'),
        'section' => 'custom_theme_article',
    ));

    // Share options
    $wp_customize->add_setting('share_options', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('share_options', array(
        'type' => 'checkbox',
        'label' => __('Show share area', 'my-theme'),
        'section' => 'custom_theme_article',
    ));

    // Pagination
    $wp_customize->add_setting('post_pagination', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('post_pagination', array(
        'type' => 'checkbox',
        'label' => __('Show post pagination', 'my-theme'),
        'section' => 'custom_theme_article',
    ));

    // Sidebar
    $wp_customize->add_setting('post_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('post_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show sidebar', 'my-theme'),
        'section' => 'custom_theme_article',
    ));
}
add_action('customize_register', 'custom_theme_posts');
