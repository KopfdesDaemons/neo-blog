<?php
function enqueue_custom_styles()
{
    $theme_directory = get_stylesheet_directory_uri();

    wp_enqueue_style('custom-styles', $theme_directory . '/style.css', array(), '1.1', 'all');
    wp_enqueue_style('fontawesome', $theme_directory . '/fonts/fontawesome/css/all.min.css', array(), '1', 'all');
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
function neo_blog_header_script()
{
    wp_enqueue_script('neo_blog-header-script', get_template_directory_uri() . '/js/neo_blog-header-script.js', null, '1.0', true);
}
add_action('wp_enqueue_scripts', 'neo_blog_header_script');


// Load the wordpress comment script from the “\wordpress\wp-includes\js” directory.
// This allows the comment response form to be located below the corresponding comment
// and not at the very bottom of the page.
function neo_blog_enqueue_comments_reply()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'neo_blog_enqueue_comments_reply');


// For the translation
function neo_blog_load_theme_textdomain()
{
    load_theme_textdomain('neo-blog', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'neo_blog_load_theme_textdomain');


// defaults to the feed as the homepage
function neo_blog_set_default_front_page()
{
    update_option('show_on_front', 'posts');
}
add_action('after_setup_theme', 'neo_blog_set_default_front_page');


function neo_blog_register_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu', 'neo-blog'),
            'footer-menu' => __('Footer Menu', 'neo-blog')
        )
    );
}
add_action('init', 'neo_blog_register_menus');

function neo_blog_register_sidebar()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'neo-blog'),
        'id' => 'my-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'neo_blog_register_sidebar');


// Custom comment form fields
function neo_blog_custom_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter(); // Get the comment author's information

    // Modify the Name field
    $fields['author'] = '<p class="comment-form-author">' .
        '<input id="author" name="author" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author']) .
        '" size="30" ' . 'aria-required="true" required />' .
        '<label for="author">' . __('Your Name', 'neo-blog') . '<span class="required">*</span></label>' .
        '</p>';

    // Modify the Email field
    $fields['email'] = '<p class="comment-form-email">' .
        '<input id="email" name="email" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author_email']) .
        '" size="30" ' . 'aria-required="true" required />' .
        '<label for="email">' . __('Your Email', 'neo-blog') . '<span class="required">*</span></label>' .
        '</p>';

    // URL field
    $fields['url'] = '<p class="comment-form-url">' .
        '<input id="url" name="url" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author_url']) .
        '" size="30" />' .
        '<label for="url">' . __('Your Website', 'neo-blog') . '</label>' .
        '</p>';

    return $fields;
}
add_filter('comment_form_default_fields', 'neo_blog_custom_comment_form_fields');


// Custom menu structure
class neo_blog_Menu_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        if (empty($item->title)) return;

        $output .= "<li class='" .  implode(" ", (array)$item->classes) . "'>";
        $output .= "<div class='neo_blog_menuitem_container'>";
        $output .= '<a href="' . esc_url($item->url) . '">';
        $output .= $item->title;
        $output .= '</a>';

        if ($args->walker->has_children) {
            $output .= '<i class="neo_blog_submenu_toggle fa fa-angle-down"></i>';
        }
        $output .= "</div>";
    }
}


// Custom Settings
require_once get_template_directory() . '/customizer-options/colors-options.php';
require_once get_template_directory() . '/customizer-options/fonts-options.php';
require_once get_template_directory() . '/customizer-options/header-options.php';
require_once get_template_directory() . '/customizer-options/feed-options.php';
require_once get_template_directory() . '/customizer-options/posts-options.php';
require_once get_template_directory() . '/customizer-options/pages-options.php';
require_once get_template_directory() . '/customizer-options/comments-options.php';
require_once get_template_directory() . '/customizer-options/author-page-options.php';
require_once get_template_directory() . '/customizer-options/mobile-options.php';


// Sanitize function to check checkbox value (true/false)
function neo_blog_sanitize_checkbox($input)
{
    return (isset($input) && true === $input) ? true : false;
}
