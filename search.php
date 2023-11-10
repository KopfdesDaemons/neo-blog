<?php get_header(); ?>
<main role="main">
    <section class="neo_blog_content_spacer neo_blog_content_and_sidebar_grid neo_blog_content_spacer_feed">
        <div class="neo_blog_feed" id="neo_blog_main_content">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 10,
                'paged' => $paged
            );

            if (have_posts()) {
                $query = get_search_query();
                echo '<h1 class="neo_blog_search_headline">' . __('Search results for', 'neo-blog') . ' "' . esc_html($query) . '"</h1>';

                while (have_posts()) {
                    the_post();
                    $post_classes = array('neo_blog_post_card neo_blog_shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'neo_blog_sticky_post';
                    }
                    // Show cards
                    require_once get_template_directory() . '/template-parts/post-card.php';
                    echo neo_blog_display_post_card($post_classes);
                }

                // Pagination only if needed
                if ($wp_query->max_num_pages > 1) {
                    echo '<div class="neo_blog_pagination neo_blog_shadow">';
                    echo '<div class="neo_blog_pagination_content">';

                    echo '<div class="neo_blog_pagination_controls">';
                    previous_posts_link(__('« Previous', 'neo-blog'));
                    echo '</div>';

                    echo '<div class="neo_blog_pagination_pages">';
                    echo paginate_links(array(
                        'total' => $wp_query->max_num_pages,
                        'current' => $paged,
                        'prev_next' => false,
                    ));
                    echo '</div>';

                    echo '<div class="neo_blog_pagination_controls">';
                    next_posts_link(__('Next »', 'neo-blog'), $wp_query->max_num_pages);
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                }

                wp_reset_postdata();
            } else {
                echo '<h1>' . __('No posts found.', 'neo-blog') . '</h1>';
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>