<?php
function neo_blog_mobile_settings($wp_customize)
{
    // Section
    $wp_customize->add_section('neo_blog_mobile_section', array(
        'title'      => __('Mobile Settings', 'neo-blog'),
        'priority'   => 30,
    ));

    // Menu Style
    $wp_customize->add_setting('header_menu_style', array(
        'default' => 'vertical',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('header_menu_style', array(
        'type' => 'select',
        'section' => 'neo_blog_mobile_section',
        'label' => __('Header menu style', 'neo-blog'),
        'choices' => array(
            'horizontal' => __('horizontal scrolling', 'neo-blog'),
            'vertical' => __('vertical arrangement with menu button', 'neo-blog'),
        ),
        'active_callback' => 'header_menu_callback'
    ));

    // Content Padding
    $wp_customize->add_setting('content_padding', array(
        'default' => '10',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('content_padding', array(
        'type' => 'number',
        'section' => 'neo_blog_mobile_section',
        'label' => __('Content Padding Pages/Posts (in pixels)', 'neo-blog'),
    ));

    // Padding Feed
    $wp_customize->add_setting('mobile_feed_padding', array(
        'default' => '5',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('mobile_feed_padding', array(
        'type' => 'number',
        'label' => __('Mobile feed spacing in pixels (padding)', 'neo-blog'),
        'section' => 'neo_blog_mobile_section',
        'input_attrs' => array(
            'min' => 0,
            'max' => 40,
            'step' => 1,
        ),
    ));
}
add_action('customize_register', 'neo_blog_mobile_settings');
