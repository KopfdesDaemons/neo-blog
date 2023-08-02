<?php

// Funktion zum Hinzufügen einer benutzerdefinierten Einstellung im Customizer
function custom_theme_header($wp_customize)
{
    // Sektionen
    $wp_customize->add_section('custom_theme_header', array(
        'title' => __('Header', 'dein-theme-textdomain'),
        'priority' => 30,
    ));

    // Optionen ######################################################################

    // Header Menü 
    $wp_customize->add_setting('fixed_header', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('fixed_header', array(
        'type' => 'checkbox',
        'label' => __('Fixiere Header', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
    ));

    // Header Menü 
    $wp_customize->add_setting('header_menu', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('header_menu', array(
        'type' => 'checkbox',
        'label' => __('Zeige Menü im Header', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
    ));
    
        // Suchleiste
        $wp_customize->add_setting('searchbar', array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_checkbox',
        ));
    
        $wp_customize->add_control('searchbar', array(
            'type' => 'checkbox',
            'label' => __('Zeige Suchleiste', 'dein-theme-textdomain'),
            'section' => 'custom_theme_header',
        ));

    // Suchbutton
    $wp_customize->add_setting('search_button', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('search_button', array(
        'type' => 'checkbox',
        'label' => __('Zeige Suchbutton', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
        'active_callback' => 'searchbar_active_callback'
    ));

    // Title
    $wp_customize->add_setting('title', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('title', array(
        'type' => 'checkbox',
        'label' => __('Zeige Titel', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
    ));

    // Title size setting
    $wp_customize->add_setting('title_size_setting', array(
        'default' => '25', // Standardmäßige Bildgröße in Pixel
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('title_size_setting', array(
        'type' => 'range',
        'section' => 'title_tagline', // Hier kannst du eine andere Sektion wählen, in der du die Einstellung platzieren möchtest
        'label' => 'Titlegröße',
        'section' => 'custom_theme_header',
        'input_attrs' => array(
            'min' => 8, // Mindestgröße in Pixel
            'max' => 50, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
        'active_callback' => 'title_active_callback'
    ));

    // Slogan
    $wp_customize->add_setting('tagline', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('tagline', array(
        'type' => 'checkbox',
        'label' => __('Zeige Slogan', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
    ));

    // actice callbacks
    function title_active_callback($control)
    {
        $menu_option_a_value = $control->manager->get_setting('title')->value();
        return $menu_option_a_value; // If Menu Option A is checked, show Menu Option B
    }

    function searchbar_active_callback($control)
    {
        $menu_option_a_value = $control->manager->get_setting('searchbar')->value();
        return $menu_option_a_value; // If Menu Option A is checked, show Menu Option B
    }
}
add_action('customize_register', 'custom_theme_header');
