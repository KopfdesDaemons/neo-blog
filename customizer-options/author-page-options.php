<?php
function neo_custom_author_page($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_author_page', array(
        'title' => __('Author Page', 'neo'),
        'priority' => 30,
    ));

    // Sidebar
    $wp_customize->add_setting('author_page_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_page_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Show sidebar', 'neo'),
        'section' => 'custom_author_page',
    ));

    // Comments
    $wp_customize->add_setting('author_page_latest_comments', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_page_latest_comments', array(
        'type' => 'checkbox',
        'label' => __('Show recent comments', 'neo'),
        'section' => 'custom_author_page',
    ));

    // Role
    $wp_customize->add_setting('author_page_role', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_page_role', array(
        'type' => 'checkbox',
        'label' => __('Show author role', 'neo'),
        'section' => 'custom_author_page',
    ));

    // Number of posts
    $wp_customize->add_setting('author_number_of_posts', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_number_of_posts', array(
        'type' => 'checkbox',
        'label' => __('Show number of posts', 'neo'),
        'section' => 'custom_author_page',
    ));

    // Registration date
    $wp_customize->add_setting('author_registration_date', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_registration_date', array(
        'type' => 'checkbox',
        'label' => __('Show registration date', 'neo'),
        'section' => 'custom_author_page',
    ));

    // Website
    $wp_customize->add_setting('author_website', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_checkbox',
    ));

    $wp_customize->add_control('author_website', array(
        'type' => 'checkbox',
        'label' => __('Show author website', 'neo'),
        'section' => 'custom_author_page',
    ));

    // Image size
    $wp_customize->add_setting('image_size_setting', array(
        'default' => '150',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('image_size_setting', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Image size', 'neo'),
        'section' => 'custom_author_page',
        'input_attrs' => array(
            'min' => 50,
            'max' => 300,
            'step' => 10,
        ),
    ));
}
add_action('customize_register', 'neo_custom_author_page');
