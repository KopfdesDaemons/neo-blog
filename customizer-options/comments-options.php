<?php
function neo_blog_custom_comments($wp_customize)
{
    // Section
    $wp_customize->add_section('custom_comments', array(
        'title' => __('Comments', 'neo-blog'),
        'priority' => 30,
    ));

    // Border radius
    $wp_customize->add_setting('comments_border_radius', array(
        'default' => '12',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('comments_border_radius', array(
        'type' => 'range',
        'label' => __('Border radius', 'neo-blog'),
        'section' => 'custom_comments',
        'input_attrs' => array(
            'min' => 0,
            'max' => 30,
            'step' => 1,
        ),
    ));

    // Inner glow
    $wp_customize->add_setting('comments_inner_glow', array(
        'default' => '50',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('comments_inner_glow', array(
        'type' => 'range',
        'label' => __('Inner glow', 'neo-blog'),
        'section' => 'custom_comments',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    ));

    // Show border
    $wp_customize->add_setting('comments_border', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('comments_border', array(
        'type' => 'checkbox',
        'label' => __('Border', 'neo-blog'),
        'section' => 'custom_comments',
    ));

    // Show image
    $wp_customize->add_setting('comments_image', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'neo_blog_sanitize_checkbox',
    ));

    $wp_customize->add_control('comments_image', array(
        'type' => 'checkbox',
        'label' => __('Show Image', 'neo-blog'),
        'section' => 'custom_comments',
    ));

    // Image size
    $wp_customize->add_setting('image_size_comments', array(
        'default' => '40',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('image_size_comments', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Image size', 'neo-blog'),
        'section' => 'custom_comments',
        'active_callback' => 'neo_blog_comments_image_active_callback',
        'input_attrs' => array(
            'min' => 20,
            'max' => 80,
            'step' => 1,
        ),
    ));

    function neo_blog_comments_image_active_callback($control)
    {
        return $control->manager->get_setting('comments_image')->value();
    }

    // Name font size
    $wp_customize->add_setting('comments_name_font_size', array(
        'default' => '14',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('comments_name_font_size', array(
        'type' => 'range',
        'section' => 'title_tagline',
        'label' => __('Name font size', 'neo-blog'),
        'section' => 'custom_comments',
        'input_attrs' => array(
            'min' => 10,
            'max' => 25,
            'step' => 1,
        ),
        'active_callback' => 'slogan_active_callback'
    ));

    // Border radius reply button
    $wp_customize->add_setting('comments_border_radius_reply_link', array(
        'default' => '8',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('comments_border_radius_reply_link', array(
        'type' => 'range',
        'label' => __('Radius reply button', 'neo-blog'),
        'section' => 'custom_comments',
        'input_attrs' => array(
            'min' => 0,
            'max' => 30,
            'step' => 1,
        ),
    ));

    // Reply button positon
    $wp_customize->add_setting('comments_reply_link_position', array(
        'default' => 'flex-start',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('comments_reply_link_position', array(
        'type' => 'select',
        'label' => __('Reply button positon', 'neo-blog'),
        'section' => 'custom_comments',
        'choices' => array(
            'flex-start' => __('left', 'neo-blog'),
            'center' => __('center', 'neo-blog'),
            'flex-end' => __('right', 'neo-blog'),
        ),
    ));

    // Date positon
    $wp_customize->add_setting('comments_date_position', array(
        'default' => 'row',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('comments_date_position', array(
        'type' => 'select',
        'label' => __('Date positon', 'neo-blog'),
        'section' => 'custom_comments',
        'choices' => array(
            'row' => __('top right corner', 'neo-blog'),
            'column' => __('under name', 'neo-blog'),
        ),
    ));

    // Max comments height
    $wp_customize->add_setting('comments_max_height', array(
        'default' => 400,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('comments_max_height', array(
        'type' => 'number',
        'label' => __('Max height in pixels', 'neo-blog'),
        'section' => 'custom_comments',
        'priority' => 10,
        'input_attrs' => array(
            'min' => 100,
            'max' => 5000,
            'step' => 1,
        ),
    ));
}
add_action('customize_register', 'neo_blog_custom_comments');
