<?php
function custom_feed($wp_customize)
{
    // Sektionen
    $wp_customize->add_section('custom_feed', array(
        'title' => __('Feed', 'my-theme'),
        'priority' => 30,
    ));

    // Optionen ######################################################################

    // Tags
    $wp_customize->add_setting('feed_post_card_tags', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('feed_post_card_tags', array(
        'type' => 'checkbox',
        'label' => __('Show tags', 'my-theme'),
        'section' => 'custom_feed',
    ));

    // Read more Link
    $wp_customize->add_setting('feed_post_card_read_more', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('feed_post_card_read_more', array(
        'type' => 'checkbox',
        'label' => __('Show read more button', 'my-theme'),
        'section' => 'custom_feed',
    ));

    // Comments Link
    $wp_customize->add_setting('feed_post_card_comments', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('feed_post_card_comments', array(
        'type' => 'checkbox',
        'label' => __('Show comments', 'my-theme'),
        'section' => 'custom_feed',
    ));

    // Line height
    $wp_customize->add_setting('feed_post_card_line_heigt', array(
        'default' => '24',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('feed_post_card_line_heigt', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Line height in text snippet', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 15, // Mindestgröße in Pixel
            'max' => 50, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
    ));

    // Border radius
    $wp_customize->add_setting('feed_post_card_border_radius', array(
        'default' => '12',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('feed_post_card_border_radius', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Border radius', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 0, // Mindestgröße in Pixel
            'max' => 50, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
    ));

    // Padding
    $wp_customize->add_setting('feed_post_card_padding', array(
        'default' => '1.5',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('feed_post_card_padding', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Padding', 'my_theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 0, // Mindestgröße
            'max' => 3, // Maximale Größe
            'step' => 0.1, // Schrittgröße für den Zähler
        ),
    ));
}
add_action('customize_register', 'custom_feed');