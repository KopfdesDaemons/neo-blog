<?php
function theme_customiz_fonts($wp_customize)
{
    // Schriftarten hinzufügen
    $wp_customize->add_section('theme_fonts_section', array(
        'title'      => __('Font', 'textdomain'),
        'description' => __('Alle Schriftarten werden lokal gehostet. Eine Zustimmung gemäß der DSGVO ist für dieses Theme nicht erforderlich (Cookie-Banner).', 'textdomain'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('body_font', array(
        'default'   => 'Quicksand, sans-serif',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('body_font', array(
        'label'      => __('Haupttext Schriftart', 'textdomain'),
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
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('line_heigt', array(
        'type' => 'range',
        'section' => 'title_tagline', // Hier kannst du eine andere Sektion wählen, in der du die Einstellung platzieren möchtest
        'label' => 'Line height in paragraphs',
        'section' => 'theme_fonts_section',
        'input_attrs' => array(
            'min' => 15, // Mindestgröße in Pixel
            'max' => 50, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
    ));

    // Font color light mode
    $wp_customize->add_setting('font_color_light_mode', array(
        'default' => '#0a0a0a',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_light_mode', array(
        'label' => 'Font color light mode',
        'section' => 'theme_fonts_section',
        'settings' => 'font_color_light_mode'
    )));

    // Font color dark mode
    $wp_customize->add_setting('font_color_dark_mode', array(
        'default' => '#c8c8c8',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_dark_mode', array(
        'label' => 'Font color dark mode',
        'section' => 'theme_fonts_section',
        'settings' => 'font_color_dark_mode'
    )));
}
add_action('customize_register', 'theme_customiz_fonts');
