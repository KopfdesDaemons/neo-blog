<?php
function enqueue_custom_styles()
{
    wp_enqueue_style('custom-font', get_stylesheet_directory_uri() . '/fonts/fonts.css', array(), '1', 'all');
    wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/styles.css', array(), '1', 'all');
    wp_enqueue_style('searchform-styles', get_stylesheet_directory_uri() . '/searchform.css', array(), '1', 'all');
    wp_enqueue_style('header-styles', get_stylesheet_directory_uri() . '/header.css', array(), '1', 'all');
    wp_enqueue_style('footer-styles', get_stylesheet_directory_uri() . '/footer.css', array(), '1', 'all');
    wp_enqueue_style('sidebar-styles', get_stylesheet_directory_uri() . '/sidebar.css', array(), '1', 'all');
    wp_enqueue_style('comments-styles', get_stylesheet_directory_uri() . '/comments.css', array(), '1', 'all');
    wp_enqueue_style('single-styles', get_stylesheet_directory_uri() . '/single.css', array(), '1', 'all');
    wp_enqueue_style('404-styles', get_stylesheet_directory_uri() . '/404.css', array(), '1', 'all');
    wp_enqueue_style('fontawesome', get_stylesheet_directory_uri() . '/fonts/fontawesome/css/all.min.css', array(), '1', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Anzahl der Wörter in der Vorschau im Feed
function mytheme_custom_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'mytheme_custom_excerpt_length', 999);

// Theme Support
add_theme_support('post-thumbnails');

function custom_comment_reply_script()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('custom-comment-reply', get_template_directory_uri() . '/js/custom-comment-reply.js', array('comment-reply'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'custom_comment_reply_script');

function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}
add_action('init', 'register_my_menus');

function sidebar()
{
    register_sidebar(array(
        'name' => __('Sidebar'),
        'id' => 'my-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'sidebar');


function custom_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter(); // Get the comment author's information

    // Change the label and input for the Author (Name) field
    $fields['author'] = '<p class="comment-form-author">' .
        '<input id="author" name="author" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author']) .
        '" size="30" ' . 'aria-required="true" required />' .
        '<label for="author">' . __('Your Name', 'domain') . '<span class="required">*</span></label>' .
        '</p>';

    // Change the label and input for the Email field
    $fields['email'] = '<p class="comment-form-email">' .
        '<input id="email" name="email" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author_email']) .
        '" size="30" ' . 'aria-required="true" required />' .
        '<label for="email">' . __('Your Email', 'domain') . '<span class="required">*</span></label>' .
        '</p>';

    // Add the URL field back with its label and input
    $fields['url'] = '<p class="comment-form-url">' .
        '<input id="url" name="url" placeholder="&nbsp;" type="text" value="' . esc_attr($commenter['comment_author_url']) .
        '" size="30" />' .
        '<label for="url">' . __('Your Website', 'domain') . '</label>' .
        '</p>';

    // Add more custom fields here if desired

    return $fields;
}

add_filter('comment_form_default_fields', 'custom_comment_form_fields');



// #########################################
// Share Buttons
// #########################################

function theme_slug_social_sharing()
{

    // Get current page URL.
    $page_url = get_permalink();

    // Get current page title.
    $page_title = get_the_title();

    // Create Array with Social Sharing links.
    $links = array(
        'facebook' => array(
            'url'  => 'https://www.facebook.com/sharer/sharer.php?u=' . $page_url . '&t=' . $page_title,
            'text' => 'Facebook',
        ),
        'twitter' => array(
            'url'  => 'https://twitter.com/intent/tweet?text=' . $page_title . '&url=' . $page_url,
            'text' => 'Twitter',
        ),
        'reddit' => array(
            'url'  => 'https://reddit.com/submit?url=' . $page_url . '&title=' . $page_title,
            'text' => 'Reddit',
        )
    );

    // Create HTML list with Social Sharing links.
    $html = '<div class="social-sharing-links"><span>Share:</span><ul>';

    foreach ($links as $key => $link) {
        $html .= sprintf(
            '<li><a class="' . $link['text'] . '" href="%1$s" target="_blank">%2$s</a></li>',
            esc_url($link['url']),
            esc_html($link['text'])
        );
    }

    $html .= '</ul></div>';

    return $html;
}



// #########################################
// Costum Settings
// #########################################

// Funktion zum Hinzufügen einer benutzerdefinierten Einstellung im Customizer
function custom_theme_header($wp_customize)
{
    // Sektionen
    // ######################################################################

    // Füge eine neue Sektion zum Customizer hinzu
    $wp_customize->add_section('custom_theme_header', array(
        'title' => __('Header', 'dein-theme-textdomain'),
        'priority' => 30,
    ));

    // Optionen
    // ######################################################################

    // Header Menü 
    $wp_customize->add_setting('fixed_header', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('fixed_header', array(
        'type' => 'checkbox',
        'label' => __('Fixiere Header', 'dein-theme-textdomain'),
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
        'label' => __('Zeige Menü im Header', 'dein-theme-textdomain'),
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
        'label' => __('Zeige Suchbutton', 'dein-theme-textdomain'),
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
        'label' => __('Zeige Suchleiste', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
    ));

    // Title
    $wp_customize->add_setting('title', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('title', array(
        'type' => 'checkbox',
        'label' => __('Zeige Titel', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
    ));

    // Slogan
    $wp_customize->add_setting('tagline', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('tagline', array(
        'type' => 'checkbox',
        'label' => __('Zeige Slogan', 'dein-theme-textdomain'),
        'section' => 'custom_theme_header',
    ));
}
add_action('customize_register', 'custom_theme_header');

function custom_theme_colors($wp_customize)
{
    // Sektionen
    // ######################################################################

    // Füge eine neue Sektion zum Customizer hinzu
    $wp_customize->add_section('custom_theme_colors', array(
        'title' => __('Colors', 'dein-theme-textdomain'),
        'priority' => 30,
    ));

    // Optionen
    // ######################################################################

    $wp_customize->add_setting('primary_color', array(
        'default' => '#0076e5',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'diwp_background_color', array(
        'label' => 'Primary Color',
        'section' => 'custom_theme_colors',
        'settings' => 'primary_color'
    )));


    $wp_customize->add_setting('dark_mode', array(
        'default' => 'dark',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_dark_mode_option',
    ));

    $wp_customize->add_control('dark_mode', array(
        'type' => 'select',
        'label' => __('Dark Mode', 'dein-theme-textdomain'),
        'section' => 'custom_theme_colors',
        'choices' => array(
            'dark' => __('Dark', 'dein-theme-textdomain'),
            'light' => __('Light', 'dein-theme-textdomain'),
            'system' => __('System', 'dein-theme-textdomain'),
        ),
    ));
}
add_action('customize_register', 'custom_theme_colors');

function custom_theme_article($wp_customize)
{
    // Sektionen
    // ######################################################################

    // Füge eine neue Sektion zum Customizer hinzu
    $wp_customize->add_section('custom_theme_article', array(
        'title' => __('Article', 'dein-theme-textdomain'),
        'priority' => 30,
    ));

    // Optionen
    // ######################################################################

    // Author Details
    $wp_customize->add_setting('author_details', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('author_details', array(
        'type' => 'checkbox',
        'label' => __('Zeige Autor Details', 'dein-theme-textdomain'),
        'section' => 'custom_theme_article',
    ));

    // Share Options
    $wp_customize->add_setting('share_options', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('share_options', array(
        'type' => 'checkbox',
        'label' => __('Zeige Teilenbereich', 'dein-theme-textdomain'),
        'section' => 'custom_theme_article',
    ));


    // Share Options
    $wp_customize->add_setting('post_pagination', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('post_pagination', array(
        'type' => 'checkbox',
        'label' => __('Zeige Post Pagination', 'dein-theme-textdomain'),
        'section' => 'custom_theme_article',
    ));

    // Tags
    $wp_customize->add_setting('tags', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('tags', array(
        'type' => 'checkbox',
        'label' => __('Zeige Tags', 'dein-theme-textdomain'),
        'section' => 'custom_theme_article',
    ));

    // Kategorien
    $wp_customize->add_setting('post_categories', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('post_categories', array(
        'type' => 'checkbox',
        'label' => __('Zeige Kategorien', 'dein-theme-textdomain'),
        'section' => 'custom_theme_article',
    ));

    // Datum
    $wp_customize->add_setting('post_date', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_checkbox',
    ));

    $wp_customize->add_control('post_date', array(
        'type' => 'checkbox',
        'label' => __('Zeige Datum', 'dein-theme-textdomain'),
        'section' => 'custom_theme_article',
    ));
}
add_action('customize_register', 'custom_theme_article');


function sanitize_dark_mode_option($input)
{
    $valid_options = array('dark', 'light', 'system');

    if (in_array($input, $valid_options)) {
        return $input;
    }

    return 'system'; // Standardwert "System", falls eine ungültige Option übergeben wird.
}

function add_darkmode_class_to_html()
{
    $dark_mode_option = get_theme_mod('dark_mode', 'system');

    if ($dark_mode_option === 'dark') {
        echo '<script>
            document.documentElement.classList.add("darkmode");
        </script>';
    } elseif ($dark_mode_option === 'system') {
        echo '<script>
            if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
                document.documentElement.classList.add("darkmode");
            }
        </script>';
    }
}
add_action('wp_head', 'add_darkmode_class_to_html', 999);

// Sanitize-Funktion zum Überprüfen des Checkbox-Werts (true/false)
function sanitize_checkbox($input)
{
    return (isset($input) && true === $input) ? true : false;
}
