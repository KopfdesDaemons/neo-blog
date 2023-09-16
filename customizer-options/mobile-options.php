<?php
function neo_mobile_settings($wp_customize)
{
    // Section
    $wp_customize->add_section('neo_mobile_section', array(
        'title'      => __('Mobile Settings', 'neo'),
        'priority'   => 30,
    ));

    // Menu Style
    $wp_customize->add_setting('header_menu_style', array(
        'default' => 'horizontal',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('header_menu_style', array(
        'type' => 'select',
        'section' => 'neo_mobile_section',
        'label' => __('Header menu style', 'neo'),
        'choices' => array(
            'horizontal' => __('horizontal scrolling', 'neo'),
            'vertical' => __('vertical arrangement with menu button', 'neo'),
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
        'section' => 'neo_mobile_section',
        'label' => __('Content Padding Pages/Posts (in pixels)', 'neo'),
    ));

    // Padding Feed
    $wp_customize->add_setting('mobile_feed_padding', array(
        'default' => '5',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('mobile_feed_padding', array(
        'type' => 'number',
        'label' => __('Mobile feed spacing in pixels (padding)', 'neo'),
        'section' => 'neo_mobile_section',
        'input_attrs' => array(
            'min' => 0,
            'max' => 40,
            'step' => 1,
        ),
    ));
}
add_action('customize_register', 'neo_mobile_settings');
