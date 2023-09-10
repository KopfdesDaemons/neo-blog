<?php
function enqueue_custom_styles()
{
    $theme_directory = get_stylesheet_directory_uri();

    $styles = array(
        'custom-font' => '/fonts/fonts.css',
        'custom-styles' => '/style.css',
        'searchform-styles' => '/searchform.css',
        'header-styles' => '/header.css',
        'footer-styles' => '/footer.css',
        'sidebar-styles' => '/sidebar.css',
        'comments-styles' => '/comments.css',
        'archive-styles' => '/archive.css',
        'single-styles' => '/single.css',
        '404-styles' => '/404.css',
        'fontawesome' => '/fonts/fontawesome/css/all.min.css',
    );

    foreach ($styles as $handle => $file) {
        wp_enqueue_style($handle, $theme_directory . $file, array(), '1', 'all');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Theme Support
add_theme_support('post-thumbnails');
add_theme_support("title-tag");
add_theme_support('automatic-feed-links');
add_theme_support('html5', array(
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
));
add_theme_support('align-wide');
add_theme_support('responsive-embeds');

// Header Script
function neo_header_script()
{
    wp_enqueue_script('neo-header-script', get_template_directory_uri() . '/js/neo-header-script.js', null, '1.0', true);
}
add_action('wp_enqueue_scripts', 'neo_header_script');

/* Load the wordpress comment script from the “\wordpress\wp-includes\js” directory.
This allows the comment response form to be located below the corresponding comment
and not at the very bottom of the page. */
function neo_enqueue_comments_reply()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'neo_enqueue_comments_reply');

// For the translation
function neo_load_theme_textdomain()
{
    load_theme_textdomain('neo', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'neo_load_theme_textdomain');

function neo_register_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu', 'neo'),
            'footer-menu' => __('Footer Menu', 'neo')
        )
    );
}
add_action('init', 'neo_register_menus');

function neo_register_sidebar()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'neo'),
        'id' => 'my-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'neo_register_sidebar');

// Custom comment form fields
function neo_custom_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter(); // Get the comment author's information

    // Modify the Name field
    $fields['author'] = '<p class="comment-form-author">' .
        '<input id="author" name="author" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author']) .
        '" size="30" ' . 'aria-required="true" required />' .
        '<label for="author">' . __('Your Name', 'neo') . '<span class="required">*</span></label>' .
        '</p>';

    // Modify the Email field
    $fields['email'] = '<p class="comment-form-email">' .
        '<input id="email" name="email" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author_email']) .
        '" size="30" ' . 'aria-required="true" required />' .
        '<label for="email">' . __('Your Email', 'neo') . '<span class="required">*</span></label>' .
        '</p>';

    // Add the URL field back with its label and input
    $fields['url'] = '<p class="comment-form-url">' .
        '<input id="url" name="url" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author_url']) .
        '" size="30" />' .
        '<label for="url">' . __('Your Website', 'neo') . '</label>' .
        '</p>';

    return $fields;
}
add_filter('comment_form_default_fields', 'neo_custom_comment_form_fields');

// Custom Settings
require_once get_template_directory() . '/customizer-options/colors-options.php';
require_once get_template_directory() . '/customizer-options/fonts-options.php';
require_once get_template_directory() . '/customizer-options/header-options.php';
require_once get_template_directory() . '/customizer-options/feed-options.php';
require_once get_template_directory() . '/customizer-options/posts-options.php';
require_once get_template_directory() . '/customizer-options/pages-options.php';
require_once get_template_directory() . '/customizer-options/author-page-options.php';
require_once get_template_directory() . '/customizer-options/mobile-options.php';


// Sanitize function to check checkbox value (true/false)
function neo_sanitize_checkbox($input)
{
    return (isset($input) && true === $input) ? true : false;
}
