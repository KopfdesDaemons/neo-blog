<?php

function neo_custom_colors($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_colors', array(
        'title' => __('Colors', 'neo'),
        'priority' => 30,
    ));

    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#0076e5',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'diwp_background_color', array(
        'label' => __('Primary Color', 'neo'),
        'section' => 'custom_theme_colors',
        'settings' => 'primary_color'
    )));

    // Element background color light mode
    $wp_customize->add_setting('element_background_color_light_mode', array(
        'default' => '#f7f7f7',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'element_background_color_light_mode', array(
        'label' => __('Element background color light mode', 'neo'),
        'section' => 'custom_theme_colors',
        'settings' => 'element_background_color_light_mode'
    )));

    // Element background color dark mode
    $wp_customize->add_setting('element_background_color_dark_mode', array(
        'default' => '#16181c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'element_background_color_dark_mode', array(
        'label' => __('Element background color dark mode', 'neo'),
        'section' => 'custom_theme_colors',
        'settings' => 'element_background_color_dark_mode'
    )));

    // Background color light mode
    $wp_customize->add_setting('background_color_light_mode', array(
        'default' => '#F0F0F0',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Background_color_light_mode', array(
        'label' => __('Background color light mode', 'neo'),
        'section' => 'custom_theme_colors',
        'settings' => 'background_color_light_mode'
    )));

    // Background color dark mode
    $wp_customize->add_setting('background_color_dark_mode', array(
        'default' => '#0a0a0a',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Background_color_dark_mode', array(
        'label' => __('Background color dark mode', 'neo'),
        'section' => 'custom_theme_colors',
        'settings' => 'background_color_dark_mode'
    )));

    // Design scheme
    $wp_customize->add_setting('dark_mode', array(
        'default' => 'dark',
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_sanitize_dark_mode_option',
    ));

    $wp_customize->add_control('dark_mode', array(
        'type' => 'select',
        'label' => __('Design scheme', 'neo'),
        'section' => 'custom_theme_colors',
        'choices' => array(
            'dark' => __('Dark', 'neo'),
            'light' => __('Light', 'neo'),
            'system' => __('System', 'neo'),
        ),
    ));
}
add_action('customize_register', 'neo_custom_colors');


function neo_sanitize_dark_mode_option($input)
{
    $valid_options = array('dark', 'light', 'system');

    if (in_array($input, $valid_options)) {
        return $input;
    }

    return 'system';
}

function neo_add_darkmode_class_to_html()
{
    $dark_mode_option = get_theme_mod('dark_mode', 'system');

    if ($dark_mode_option === 'dark') {
        echo '<script>
            document.documentElement.classList.add("darkmode");
        </script>';
    } elseif ($dark_mode_option === 'system') {
        echo '<script>
            if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
                document.documentElement.classList.add("darkmode");
            }
        </script>';
    }
}
add_action('wp_head', 'neo_add_darkmode_class_to_html', 999);
