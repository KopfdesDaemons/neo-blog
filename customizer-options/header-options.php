<?php
function custom_theme_header($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_theme_header', array(
        'title' => __('Header', 'my-theme'),
        'priority' => 30,
    ));

    // Fix header
    $wp_customize->add_setting('fixed_header', array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('fixed_header', array(
        'type' => 'checkbox',
        'label' => __('Fix Header', 'my-theme'),
        'section' => 'custom_theme_header',
    ));

    // Header menu
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

    // Home page link
    $wp_customize->add_setting('home_page_link', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('home_page_link', array(
        'type' => 'checkbox',
        'label' => __('Show link to home page', 'my-theme'),
        'section' => 'custom_theme_header',
    ));

    // Searchbar
    $wp_customize->add_setting('searchbar', array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('searchbar', array(
        'type' => 'checkbox',
        'label' => __('Show search bar', 'my-theme'),
        'section' => 'custom_theme_header',
    ));

    // Search button
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
        'default' => '25',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('title_size_setting', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Title size', 'my-theme'),
        'section' => 'custom_theme_header',
        'input_attrs' => array(
            'min' => 8,
            'max' => 50,
            'step' => 1,
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

    // Slogan size setting
    $wp_customize->add_setting('slogan_size_setting', array(
        'default' => '14',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('slogan_size_setting', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Slogan size', 'my-theme'),
        'section' => 'custom_theme_header',
        'input_attrs' => array(
            'min' => 8,
            'max' => 50,
            'step' => 1,
        ),
        'active_callback' => 'slogan_active_callback'
    ));

    // Background for titel and slogan
    $wp_customize->add_setting('header_text_background', array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('header_text_background', array(
        'type' => 'checkbox',
        'label' => __('Text background', 'my-theme'),
        'section' => 'custom_theme_header',
    ));

    // Header gap / spacing
    $wp_customize->add_setting('header_gap', array(
        'default' => '0',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('header_gap', array(
        'type' => 'range',
        'section' => 'title_tagline',
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
        return $control->manager->get_setting('title')->value();
    }

    function slogan_active_callback($control)
    {
        return $control->manager->get_setting('tagline')->value();
    }

    function searchbar_active_callback($control)
    {
        return $control->manager->get_setting('searchbar')->value();
    }

    function background_image_callback($control)
    {
        return $control->manager->get_setting('header_background_image')->value();
    }

    function header_menu_callback($control)
    {
        return $control->manager->get_setting('header_menu')->value();
    }

    // Background image
    $wp_customize->add_setting('header_background_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'image_control2', array(
        'label' => __('Background image', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_background_image',
        'type' => 'image',
        'mime_type' => 'image',
    )));

    // Backgoundimage saturation
    $wp_customize->add_setting('header_background_saturation', array(
        'default' => '80',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('header_background_saturation', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Background image saturation', 'my-theme'),
        'section' => 'custom_theme_header',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
        'active_callback' => 'background_image_callback'
    ));

    // Banner image
    $wp_customize->add_setting('header_banner', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'image_control', array(
        'label' => __('Banner image', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_banner',
    )));

    // Font color light mode
    $wp_customize->add_setting('header_font_color_light_mode', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_light_mode2', array(
        'label' => __('Font color light mode', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_font_color_light_mode'
    )));

    // Font color dark mode
    $wp_customize->add_setting('header_font_color_dark_mode', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_dark_mode2', array(
        'label' => __('Font color dark mode', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_font_color_dark_mode'
    )));

    // Font color menu
    $wp_customize->add_setting('header_menu_font_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'font_color_header_menu', array(
        'label' => __('Font color menu', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_menu_font_color',
        'active_callback' => 'header_menu_callback'
    )));

    // Menu backgound color
    $wp_customize->add_setting('header_menu_background_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_menu_background_color', array(
        'label' => __('Menu backgound color', 'my-theme'),
        'section' => 'custom_theme_header',
        'settings' => 'header_menu_background_color',
        'active_callback' => 'header_menu_callback'
    )));
}
add_action('customize_register', 'custom_theme_header');