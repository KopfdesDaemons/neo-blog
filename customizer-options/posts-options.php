<?php
function neo_blog_custom_posts($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_article', array(
        'title' => __('Posts', 'neo-blog'),
        'priority' => 30,
        'description' => __('Settings of the individual posts.', 'neo-blog')
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
        'label' => __('Maximum width of posts', 'neo-blog'),
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
        'label' => __('Heading font size', 'neo-blog'),
        'section' => 'custom_theme_article',
        'input_attrs' => array(
            'min' => 24,
            'max' => 50,
            'step' => 1,
        ),
        'active_callback' => 'slogan_active_callback'
    ));

    // Title text alignment
    $wp_customize->add_setting('posts_title_alignment', array(
        'default' => 'left',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('posts_title_alignment', array(
        'type' => 'select',
        'section' => 'custom_theme_article',
        'label' => __('Page Title Alignment', 'neo-blog'),
        'choices' => array(
            'left' => __('left', 'neo-blog'),
            'center' => __('center', 'neo-blog'),
            'right' => __('right', 'neo-blog'),
        ),
    ));

    // Background color
    $wp_customize->add_setting('background_color_posts', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Posts_background_color', array(
        'label' => __('Background color light mode', 'neo-blog'),
        'section' => 'custom_theme_article',
        'settings' => 'background_color_posts'
    )));

    // Background color darkmode
    $wp_customize->add_setting('dark_mode_background_color_posts', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Post_background_color_dark_mode', array(
        'label' => __('Background color dark mode', 'neo-blog'),
        'section' => 'custom_theme_article',
        'settings' => 'dark_mode_background_color_posts'
    )));

    // Date
    $wp_customize->add_setting('post_date', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_date', array(
        'type' => 'checkbox',
        'label' => __('Show date', 'neo-blog'),
        'section' => 'custom_theme_article',
    ));

    // Categories
    $wp_customize->add_setting('post_categories', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_categories', array(
        'type' => 'checkbox',
        'label' => __('Show categories', 'neo-blog'),
        'section' => 'custom_theme_article',
    ));

    // Tags
    $wp_customize->add_setting('tags', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('tags', array(
        'type' => 'checkbox',
        'label' => __('Show tags', 'neo-blog'),
        'section' => 'custom_theme_article',
    ));

    // Author details
    $wp_customize->add_setting('author_details', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_details', array(
        'type' => 'checkbox',
        'label' => __('Show author details', 'neo-blog'),
        'section' => 'custom_theme_article',
    ));

    // Pagination
    $wp_customize->add_setting('post_pagination', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_pagination', array(
        'type' => 'checkbox',
        'label' => __('Show post pagination', 'neo-blog'),
        'section' => 'custom_theme_article',
    ));

    // Sidebar
    $wp_customize->add_setting('post_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('post_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show sidebar', 'neo-blog'),
        'section' => 'custom_theme_article',
    ));
}
add_action('customize_register', 'neo_blog_custom_posts');
