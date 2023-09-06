<?php
function theme_customiz_fonts($wp_customize)
{
    // Section
    $wp_customize->add_section('theme_fonts_section', array(
        'title'      => __('Font', 'neo'),
        'description' => __('All fonts are hosted locally. Consent according to the GDPR is not required for this theme (cookie banner).', 'neo'),
        'priority'   => 30,
    ));

    // Fonts
    $wp_customize->add_setting('body_font', array(
        'default'   => 'Quicksand, sans-serif',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('body_font', array(
        'label'      => __('Main text font', 'neo'),
        'section'    => 'theme_fonts_section',
        'type'       => 'select',
        'choices'    => array(
            'Arial, sans-serif' => 'Arial',
            'Courier New, monospace' => 'Courier New',
            'Georgia, serif' => 'Georgia',
            'Lato, sans-serif' => 'Lato',
            'Lucida Console, monospace' => 'Lucida Console',
            'Montserrat, sans-serif' => 'Montserrat',
            'Noto Sans JP, sans-serif' => 'Noto Sans JP',
            'Open Sans, sans-serif' => 'Open Sans',
            'Poppins, sans-serif' => 'Poppins',
            'Quicksand, sans-serif' => 'Quicksand',
            'Roboto, sans-serif' => 'Roboto',
            'Tahoma, sans-serif' => 'Tahoma',
            'Times New Roman, serif' => 'Times New Roman',
            'Trebuchet MS, sans-serif' => 'Trebuchet MS',
            'Verdana, sans-serif' => 'Verdana'
        ),
    ));

    // Line height
    $wp_customize->add_setting('line_heigt', array(
        'default' => '24',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('line_heigt', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Line height in paragraphs', 'neo'),
        'section' => 'theme_fonts_section',
        'input_attrs' => array(
            'min' => 15,
            'max' => 50,
            'step' => 1,
        ),
    ));

    // Font color light mode
    $wp_customize->add_setting('font_color_light_mode', array(
        'default' => '#0a0a0a',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_light_mode', array(
        'label' => __('Font color light mode', 'neo'),
        'section' => 'theme_fonts_section',
        'settings' => 'font_color_light_mode'
    )));

    // Font color dark mode
    $wp_customize->add_setting('font_color_dark_mode', array(
        'default' => '#c8c8c8',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_dark_mode', array(
        'label' => __('Font color dark mode', 'neo'),
        'section' => 'theme_fonts_section',
        'settings' => 'font_color_dark_mode'
    )));
}
add_action('customize_register', 'theme_customiz_fonts');
