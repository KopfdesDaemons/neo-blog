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
<li class="comment" <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
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
                <a href="#" class="reply-link"><?php _e('Reply'); ?></a>
                <?php edit_comment_link(__('✏️'), '  ', ''); ?>
            </div>
            <div class="comment-form-reply" style="display: none;">
                <form class="comment-form" method="post" action="<?php echo site_url('/wp-comments-post.php'); ?>">
                    <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                    <input type="hidden" name="comment_parent" value="<?php echo get_comment_ID(); ?>">
                    <textarea name="comment" class="comment-input" required></textarea>
                    <input type="submit" class="comment-submit" value="<?php _e('Submit'); ?>">
                </form>
            </div>
        </div>
    </div>
    <?php
}

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