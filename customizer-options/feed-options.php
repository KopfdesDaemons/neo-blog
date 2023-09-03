<?php
function custom_feed($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_feed', array(
        'title' => __('Feed', 'my-theme'),
        'priority' => 30,
    ));

    // Maximum width of the feed
    $wp_customize->add_setting('maximum_width_of_the_feed', array(
        'default' => '70',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('maximum_width_of_the_feed', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Maximum width of the feed', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 50,
            'max' => 150,
            'step' => 1,
        ),
    ));

    // Number of posts in feed
    $wp_customize->add_setting('feed_posts_count', array(
        'default' => 10,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('feed_posts_count', array(
        'type' => 'number',
        'label' => __('Number of posts', 'my-theme'),
        'section' => 'custom_feed',
        'priority' => 10,
        'input_attrs' => array(
            'min' => 1,
            'max' => 20,
            'step' => 1,
        ),
    ));

    // Posts Spacing
    $wp_customize->add_setting('feed_post_card_spacing', array(
        'default' => '2',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('feed_post_card_spacing', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Spacing between posts', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 0,
            'max' => 10,
            'step' => 0.1,
        ),
    ));

    // Number of word in snippet
    $wp_customize->add_setting('words_in_snippet', array(
        'default' => 30,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('words_in_snippet', array(
        'type' => 'number',
        'label' => __('Number of words in the snippet', 'my-theme'),
        'section' => 'custom_feed',
        'priority' => 10,
        'input_attrs' => array(
            'min' => 1,
            'max' => 100,
            'step' => 1,
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
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('tags_border_radius', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Tags border radius', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'tags_active_callback',
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
            'step' => 1,
        ),
    ));

    // Read more link
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

    // Comments link
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
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('feed_post_card_line_heigt', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Line height in text snippet', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 15,
            'max' => 50,
            'step' => 1,
        ),
    ));

    // Border radius
    $wp_customize->add_setting('feed_post_card_border_radius', array(
        'default' => '12',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('feed_post_card_border_radius', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Border radius', 'my-theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
            'step' => 1,
        ),
    ));

    // Padding
    $wp_customize->add_setting('feed_post_card_padding', array(
        'default' => '1.5',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('feed_post_card_padding', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Padding', 'my_theme'),
        'section' => 'custom_feed',
        'input_attrs' => array(
            'min' => 0,
            'max' => 3,
            'step' => 0.1,
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

    // Image position
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

    // Image display behavior
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
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('feed_post_card_border_radius_image', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Image radius', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'image_active_callback',
        'input_attrs' => array(
            'min' => 0,
            'max' => 150,
            'step' => 1,
        ),
    ));

    // Image size
    $wp_customize->add_setting('feed_image_height', array(
        'default' => '15em',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('feed_image_height', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Image height', 'my-theme'),
        'section' => 'custom_feed',
        'active_callback' => 'image_active_callback',
        'input_attrs' => array(
            'min' => 0,
            'max' => 30,
            'step' => 1,
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

// Number of words previewed in the feed
function mytheme_custom_excerpt_length($length)
{
    return get_theme_mod('words_in_snippet');
}
add_filter('excerpt_length', 'mytheme_custom_excerpt_length', 999);

// Characters after snippet
function custom_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');
