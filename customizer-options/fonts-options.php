<?php
function theme_customiz_fonts($wp_customize)
{
    // Schriftarten hinzufügen
    $wp_customize->add_section('theme_fonts_section', array(
        'title'      => __('Schrift', 'textdomain'),
        'description' => __('Alle Schriftarten werden lokal gehostet. Eine Zustimmung gemäß der DSGVO ist für dises Theme nicht erforderlich (Cookie-Banner).', 'textdomain'),
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
}
add_action('customize_register', 'theme_customiz_fonts');
