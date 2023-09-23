<?php
function neo_blog_custom_fonts($wp_customize)
{
    // Section
    $wp_customize->add_section('theme_fonts_section', array(
        'title'      => __('Font', 'neo-blog'),
        'description' => __('All fonts are hosted locally. Consent according to the GDPR is not required for this theme (cookie banner).', 'neo-blog'),
        'priority'   => 30,
    ));

    // Fonts
    $wp_customize->add_setting('body_font', array(
        'default'   => 'Quicksand, sans-serif',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('body_font', array(
        'label'      => __('Main text font', 'neo-blog'),
        'section'    => 'theme_fonts_section',
        'type'       => 'select',
        'choices'    => array(
            'Arial, sans-serif' => 'Arial',
            'monospace' => 'Monospace',
            'Quicksand, sans-serif' => 'Quicksand',
            'Courier New, monospace' => 'Courier New',
            'Georgia, serif' => 'Georgia',
            'Lato, sans-serif' => 'Lato',
            'Lucida Console, monospace' => 'Lucida Console',
            'Montserrat, sans-serif' => 'Montserrat',
            'Noto Sans JP, sans-serif' => 'Noto Sans JP',
            'Open Sans, sans-serif' => 'Open Sans',
            'Poppins, sans-serif' => 'Poppins',
            'Roboto, sans-serif' => 'Roboto',
            'Tahoma, sans-serif' => 'Tahoma',
            'Times New Roman, serif' => 'Times New Roman',
            'Trebuchet MS, sans-serif' => 'Trebuchet MS',
            'Verdana, sans-serif' => 'Verdana',
        ),
    ));

    // Font color light mode
    $wp_customize->add_setting('font_color_light_mode', array(
        'default' => '#0a0a0a',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_light_mode', array(
        'label' => __('Font color light mode', 'neo-blog'),
        'section' => 'theme_fonts_section',
        'settings' => 'font_color_light_mode'
    )));

    // Font color dark mode
    $wp_customize->add_setting('font_color_dark_mode', array(
        'default' => '#c8c8c8',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_dark_mode', array(
        'label' => __('Font color dark mode', 'neo-blog'),
        'section' => 'theme_fonts_section',
        'settings' => 'font_color_dark_mode'
    )));
}
add_action('customize_register', 'neo_blog_custom_fonts');
