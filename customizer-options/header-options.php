<?php

// Funktion zum Hinzufügen einer benutzerdefinierten Einstellung im Customizer
function custom_theme_header($wp_customize)
{
    // Sektionen
    $wp_customize->add_section('custom_theme_header', array(
        'title' => __('Header', 'my-theme'),
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
        'label' => __('Fix Header', 'my-theme'),
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
        'label' => __('Show menu in header', 'my-theme'),
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
        'label' => __('Show search bar', 'my-theme'),
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
        'label' => __('Show search button', 'my-theme'),
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
        'label' => __('Show title', 'my-theme'),
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
        'label' => __('Title size', 'my-theme'),
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
        'label' => __('Show slogan', 'my-theme'),
        'section' => 'custom_theme_header',
    ));

    // Header gap / Spacing
    $wp_customize->add_setting('header_gap', array(
        'default' => '0',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('header_gap', array(
        'type' => 'range',
        'section' => 'title_tagline', // Hier kannst du eine andere Sektion wählen, in der du die Einstellung platzieren möchtest
        'label' => __('Element spacing', 'my-theme'),
        'section' => 'custom_theme_header',
        'input_attrs' => array(
            'min' => 0,
            'max' => 15,
            'step' => 0.1,
        ),
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

    function background_image_callback($control)
    {
        $backgound_image = $control->manager->get_setting('header_background_image')->value();
        return $backgound_image;
    }

    function header_menu_callback($control)
    {
        $header_menu = $control->manager->get_setting('header_menu')->value();
        return $header_menu;
    }

    // Background Image
    $wp_customize->add_setting('header_background_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw', // Um sicherzustellen, dass es eine URL ist
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'image_control2', array(
        'label' => __('Background image', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_background_image',
        'type' => 'image', // Setze den Steuerungstyp auf Bild
        'mime_type' => 'image', // Beschränke den Dateityp auf Bilder
    )));

    // Backgoundimage saturation
    $wp_customize->add_setting('header_background_saturation', array(
        'default' => '80',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('header_background_saturation', array(
        'type' => 'range',
        'section' => 'title_tagline', // Hier kannst du eine andere Sektion wählen, in der du die Einstellung platzieren möchtest
        'label' => __('Background image saturation', 'my-theme'),
        'section' => 'custom_theme_header',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'active_callback' => 'background_image_callback'
    ));

    // Banner Image
    $wp_customize->add_setting('header_banner', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw', // Um sicherzustellen, dass es eine URL ist
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'image_control', array(
        'label' => __('Banner image', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_banner',
    )));

    // Font color light mode
    $wp_customize->add_setting('header_font_color_light_mode', array(
        'default' => '',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_light_mode2', array(
        'label' => __('Font color light mode', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_font_color_light_mode'
    )));

    // Font color dark mode
    $wp_customize->add_setting('header_font_color_dark_mode', array(
        'default' => '',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_dark_mode2', array(
        'label' => __('Font color dark mode', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_font_color_dark_mode'
    )));

    // Font color menu
    $wp_customize->add_setting('header_menu_font_color', array(
        'default' => '',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_header_menu', array(
        'label' => __('Font color menu', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_menu_font_color',
        'active_callback' => 'header_menu_callback'
    )));

    // Mneu backgound color
    $wp_customize->add_setting('header_menu_background_color', array(
        'default' => '',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_menu_background_color', array(
        'label' => __('Menu backgound color', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_menu_background_color',
        'active_callback' => 'header_menu_callback'
    )));
}
add_action('customize_register', 'custom_theme_header');