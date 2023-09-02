<?php
function custom_feed($wp_customize)
{
    // Sektionen
    $wp_customize->add_section('custom_feed', array(
        'title' => __('Feed', 'my-theme'),
        'priority' => 30,
    ));

    // Optionen ######################################################################

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

    $wp_customize->add_setting('feed_posts_count', array(
        'default' => 10, // Standardmäßig 5 Beiträge im Feed
        'sanitize_callback' => 'absint', // Sicherheitsfunktion, um sicherzustellen, dass die Eingabe eine ganze Zahl ist
    ));

    $wp_customize->add_control('feed_posts_count', array(
        'type' => 'number',
        'label' => __('Number of posts', 'my-theme'),
        'section' => 'custom_feed',
        'priority' => 10, // Priorität der Option im Customizer
        'input_attrs' => array(
            'min' => 1, // Mindestwert für die Anzahl der Beiträge
            'max' => 20, // Maximalwert für die Anzahl der Beiträge
            'step' => 1, // Schrittgröße für die Anzahl der Beiträge
        ),
    ));

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

    $wp_customize->add_setting('words_in_snippet', array(
        'default' => 30, // Standardmäßig 5 Beiträge im Feed
        'sanitize_callback' => 'absint', // Sicherheitsfunktion, um sicherzustellen, dass die Eingabe eine ganze Zahl ist
    ));

    $wp_customize->add_control('words_in_snippet', array(
        'type' => 'number',
        'label' => __('Number of words in the snippet', 'my-theme'),
        'section' => 'custom_feed',
        'priority' => 10, // Priorität der Option im Customizer
        'input_attrs' => array(
            'min' => 1, // Mindestwert für die Anzahl der Beiträge
            'max' => 100, // Maximalwert für die Anzahl der Beiträge
            'step' => 1, // Schrittgröße für die Anzahl der Beiträge
        ),
    ));


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

    // Tags border radius
    $wp_customize->add_setting('tags_border_radius', array(
        'default' => '32',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('tags_border_radius', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Tags border radius', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'tags_active_callback',
        'input_attrs' => array(
            'min' => 0, // Mindestgröße in Pixel
            'max' => 50, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
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

    $wp_customize->add_setting('image_display_behavior', array(
        'default' => 'cover',
        'transport' => 'refresh'
    ));

    $wp_customize->add_control('image_display_behavior', array(
        'type' => 'select',
        'label' => __('Image display behavior', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'image_active_callback',
        'choices' => array(
            'cover' => 'cover',
            'contain' => 'contain',
            'fill' => 'fill',
            'scale-down' => 'scale-down',
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

    // Image size
    $wp_customize->add_setting('feed_image_height', array(
        'default' => '15em',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint', // Nur positive Ganzzahlen erlauben
    ));

    $wp_customize->add_control('feed_image_height', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Image height', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'image_active_callback',
        'input_attrs' => array(
            'min' => 0, // Mindestgröße in Pixel
            'max' => 30, // Maximale Größe in Pixel
            'step' => 1, // Schrittgröße für den Zähler
        ),
    ));

    function image_active_callback($control)
    {
        return $control->manager->get_setting('feed_post_card_image')->value();
    }

    function tags_active_callback($control)
    {
        return $control->manager->get_setting('feed_post_card_tags')->value();
    }
}
add_action('customize_register', 'custom_feed');
