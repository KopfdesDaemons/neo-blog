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

    // Show image
    $wp_customize->add_setting('feed_post_card_image', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('feed_post_card_image', array(
        'type' => 'checkbox',
        'label' => __('Show image', 'my-theme'),
        'section' => 'custom_feed',
    ));

    $wp_customize->add_setting('feed_image_postion', array(
        'default' => 'imageLeft',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control('feed_image_postion', array(
        'type' => 'select',
        'label' => __('Image postion', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'image_active_callback',
        'choices' => array(
            'imageLeft' => __('left', 'my-theme'),
            'imageTop' => __('top', 'my-theme'),
        ),
    ));

    // Border radius image
    $wp_customize->add_setting('feed_post_card_border_radius_image', array(
        'default' => '10',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('feed_post_card_border_radius_image', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Image radius', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'image_active_callback',
        'input_attrs' => array(
            'min' => 0, // Mindestgröße in Pixel
            'max' => 150, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
    ));

    function image_active_callback($control)
    {
        $image = $control->manager->get_setting('feed_post_card_image')->value();
        return $image;
    }

    // Posts Spacing
    $wp_customize->add_setting('feed_post_card_spacing', array(
        'default' => '2',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('feed_post_card_spacing', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Spacing between posts', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 0, // Mindestgröße in Pixel
            'max' => 10, // Maximale Größe in Pixel
            'step' => 0.1, // Schrittgröße für den Zähler
        ),
    ));

    // maximum width of the feed
    $wp_customize->add_setting('maximum_width_of_the_feed', array(
        'default' => '70',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('maximum_width_of_the_feed', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Maximum width of the feed', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 50, // Mindestgröße in Pixel
            'max' => 150, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
    ));
}
add_action('customize_register', 'custom_feed');
