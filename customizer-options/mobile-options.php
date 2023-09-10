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
        'label' => __('Menu style', 'neo'),
        'choices' => array(
            'horizontal' => __('horizontal scrolling', 'neo'),
            'vertical' => __('vertical arrangement with menu button', 'neo'),
        ),
        'active_callback' => 'header_menu_callback'
    ));
}
add_action('customize_register', 'neo_mobile_settings');
