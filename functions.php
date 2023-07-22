<?php
function enqueue_custom_styles()
{
    wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/styles.css', array(), '1', 'all');
    wp_enqueue_style('searchform-styles', get_stylesheet_directory_uri() . '/searchform.css', array(), '1', 'all');
    wp_enqueue_style('header-styles', get_stylesheet_directory_uri() . '/header.css', array(), '1', 'all');
    wp_enqueue_style('sidebar-styles', get_stylesheet_directory_uri() . '/sidebar.css', array(), '1', 'all');
    wp_enqueue_style('comments-styles', get_stylesheet_directory_uri() . '/comments.css', array(), '1', 'all');
    wp_enqueue_style('single-styles', get_stylesheet_directory_uri() . '/single.css', array(), '1', 'all');
    wp_enqueue_style('custom-font', get_stylesheet_directory_uri() . '/fonts/fonts.css', array(), '1', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Anzahl der Wörter in der Vorschau im Feed
function mytheme_custom_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'mytheme_custom_excerpt_length', 999);



function custom_comment_callback($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <div class="commentCard">
        <div class="profilepicture">
            <?php
                if ($args['avatar_size'] != 0) {
                    $avatar = get_avatar($comment, $args['avatar_size']);
                    $author_link = get_comment_author_link($comment);
                    if (get_comment_author_url($comment) && $comment->user_id != 0) {
                        $avatar_with_link = sprintf('<a href="%1$s" rel="nofollow">%2$s</a>', esc_url(get_comment_author_url($comment)), $avatar);
                        echo $avatar_with_link;
                    } else {
                        echo $avatar;
                    }
                }
                ?>
        </div>
        <div class="commentContent">
            <header>
                <span class="name">
                    <?php
                        if (get_comment_author_url($comment) && $comment->user_id != 0) {
                            $author_link = get_comment_author_link($comment);
                            printf('<a href="%1$s" rel="nofollow">%2$s</a>', esc_url(get_comment_author_url($comment)), get_comment_author($comment));
                        } else {
                            printf(get_comment_author($comment));
                        }
                        ?>
                </span>
                <span class="date">
                    <?php printf(get_comment_date('d.m.Y')); ?>
                </span>
            </header>
            <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em><br />
            <?php endif; ?>
            <div class="commentText">
                <?php comment_text(); ?>
            </div>
            <div class="reply">
                <?php
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'respond_id' => 'respond',
                                'reply_text' => __('Reply'),
                                'login_text' => __('Log in to Reply'),
                            )
                        )
                    );
                    ?>
                <?php edit_comment_link(__('✏️'), '  ', ''); ?>
            </div>
        </div>
    </div>
    <?php if ($args['max_depth'] > $depth) { ?>
    <div class="comment-form-container" style="display:none;">
        <?php
                comment_form(
                    array(
                        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') . '</label><br /><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
                        'title_reply' => '',
                        'class_submit' => 'submit-button',
                        'logged_in_as' => '',
                        'comment_parent' => $comment->comment_ID
                    )
                );
                ?>
    </div>
    <?php } ?>
    <?php
}

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
            'header-menu' => __('Header Menu')
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


// Share Buttons

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