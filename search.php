<?php get_header(); ?>
<main role="main">
    <section class="neo_blog_content_spacer neo_blog_content_and_sidebar_grid">
        <div class="neo_blog_feed" id="neo_main_content">
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

                // Pagination
                if ($wp_query->max_num_pages > 1) {
                    echo '<div class="neo_blog_pagination neo_blog_shadow">';
                    echo paginate_links(array(
                        'total' => $wp_query->max_num_pages,
                        'current' => $paged,
                        'prev_next' => true,
                        'prev_text' => __('« Previous', 'neo-blog'),
                        'next_text' => __('Next »', 'neo-blog'),
                    ));
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