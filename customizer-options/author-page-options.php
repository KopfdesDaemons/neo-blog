<?php
function custom_author_page($wp_customize)
{
    // Sektionen
    $wp_customize->add_section('custom_author_page', array(
        'title' => __('Author Page', 'dein-theme-textdomain'),
        'priority' => 30,
    ));

    // Optionen ######################################################################

    // Sidebar
    $wp_customize->add_setting('author_page_sidebar', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_page_sidebar', array(
        'type' => 'checkbox',
        'label' => __('Zeige Sidebar', 'dein-theme-textdomain'),
        'section' => 'custom_author_page',
    ));

    // Comments
    $wp_customize->add_setting('author_page_latest_comments', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_page_latest_comments', array(
        'type' => 'checkbox',
        'label' => __('Zeige letze Kommentare', 'dein-theme-textdomain'),
        'section' => 'custom_author_page',
    ));

    // Role
    $wp_customize->add_setting('author_page_role', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_page_role', array(
        'type' => 'checkbox',
        'label' => __('Zeige Autorenrolle', 'dein-theme-textdomain'),
        'section' => 'custom_author_page',
    ));

    // Role
    $wp_customize->add_setting('author_number_of_posts', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_number_of_posts', array(
        'type' => 'checkbox',
        'label' => __('Zeige Anzahl der Beiträge', 'dein-theme-textdomain'),
        'section' => 'custom_author_page',
    ));

    // Registraiton Date
    $wp_customize->add_setting('author_registration_date', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_registration_date', array(
        'type' => 'checkbox',
        'label' => __('Zeige Regestrierungsdatum', 'dein-theme-textdomain'),
        'section' => 'custom_author_page',
    ));

    // Website
    $wp_customize->add_setting('author_website', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_website', array(
        'type' => 'checkbox',
        'label' => __('Zeige Autor Website', 'dein-theme-textdomain'),
        'section' => 'custom_author_page',
    ));

    // Image size setting
    $wp_customize->add_setting('image_size_setting', array(
        'default' => '150', // Standardmäßige Bildgröße in Pixel
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('image_size_setting', array(
        'type' => 'range',
        'section' => 'title_tagline', // Hier kannst du eine andere Sektion wählen, in der du die Einstellung platzieren möchtest
        'label' => 'Bildgröße',
        'section' => 'custom_author_page',
        'input_attrs' => array(
            'min' => 50, // Mindestgröße in Pixel
            'max' => 300, // Maximale Größe in Pixel
            'step' => 10, // Schrittgröße für den Zähler
        ),
    ));
}
add_action('customize_register', 'custom_author_page');
