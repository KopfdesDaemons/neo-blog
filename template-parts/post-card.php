<?php
function neo_blog_display_post_card($post_classes)
{
    ob_start(); // Start output buffering
?>
    <div class="<?php echo implode(' ', $post_classes) . ' ' . get_theme_mod('feed_image_postion', 'neo_blog_post_card_image_left'); ?>">
        <?php if (has_post_thumbnail() && get_theme_mod('feed_post_card_image', true)) { ?>
            <a class="neo_blog_post_card_image_container" href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            </a>
        <?php } ?>
        <div class="neo_blog_post_card_content_div">
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>
            <span class="neo_blog_post_card_image_date"><?php the_date(); ?></span>
            <?php the_excerpt(); ?>
            <div class="neo_blog_post_card_tags_div">
                <?php
                if (get_theme_mod('feed_post_card_tags', true)) {
                    $tags = get_the_tags();
                    if ($tags) {
                        echo '<ul>';
                        foreach ($tags as $tag) {
                            $tag_link = get_tag_link($tag->term_id);
                            echo '<li><a href="' . $tag_link . '">' . $tag->name . '</a></li>';
                        }
                        echo '</ul>';
                    }
                }
                ?>
            </div>
            <div class="neo_blog_post_card_buttom_row">
                <span class="neo_blog_post_card_pin">📌</span>
                <div class="neo_blog_post_card_link_div">
                    <?php if (get_theme_mod('feed_post_card_comments', true)) { ?>

                        <a href="<?php comments_link(); ?>" class="neo_blog_post_card_comments_count">
                            <?php
                            $neo_blog_post_card_comments_count = get_comments_number();
                            echo '<span>' . $neo_blog_post_card_comments_count . '</span>' . '<span>💬</span>';
                            ?>
                        </a>
                    <?php } ?>

                    <?php if (get_theme_mod('feed_post_card_read_more', true)) {
                        echo '<a class="neo_blog_post_card_read_more" href="' . get_permalink() . '">' . __('read more', 'neo_blog') . '</a>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean(); // Return the buffered output as a string
}
