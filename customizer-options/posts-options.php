<?php
function custom_theme_posts($wp_customize)
{
    // Sektionen
    $wp_customize->add_section('custom_theme_article', array(
        'title' => __('Posts', 'my-theme'),
        'priority' => 30,
        'description' => __('Settings of the individual posts.', 'my-theme')
    ));

    // Optionen ######################################################################

    // Datum
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

    // Kategorien
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

    // Author Details
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

    // Share Options
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