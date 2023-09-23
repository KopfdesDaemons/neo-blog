<?php get_header(); ?>
<main role="main">
    <section class="neo_blog_content_spacer neo_blog_content_and_sidebar_grid neo_blog_content_spacer_feed">
        <div class="neo_blog_feed">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $posts_per_page = get_option('posts_per_page');
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $posts_per_page,
                'paged' => $paged
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $post_classes = array('neo_blog_post_card neo_blog_shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'neo_blog_sticky_post';
                    }

                    // Show Cards
                    require_once get_template_directory() . '/template-parts/post-card.php';
                    echo neo_blog_display_post_card($post_classes);
                }

                // Pagination only if needed
                if ($query->max_num_pages > 1) {
                    echo '<div class="neo_blog_pagination neo_blog_shadow">';
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'prev_next' => true,
                        'prev_text' => __('« Previous', 'neo_blog'),
                        'next_text' => __('Next »', 'neo_blog'),
                    ));
                    echo '</div>';
                }

                wp_reset_postdata();
            } else {
                echo esc_html__('No posts found.', 'neo_blog');
            }
            ?>
        </div>
        <?php if (get_theme_mod('feed_sidebar', true)) get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>