<?php get_header(); ?>
<main role="main">
    <section class="neo_content_spacer neo_content_and_sidebar_grid neo_content_spacer_feed">
        <div class="neo_feed">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Query current page
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => get_theme_mod('feed_posts_count'), // Number of posts per page
                'paged' => $paged
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $post_classes = array('neo_post_card neo_shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'neo_sticky_post';
                    }

                    // Show Cards
                    require_once get_template_directory() . '/template-parts/post-card.php';
                    echo neo_display_post_card($post_classes);
                }

                // Pagination only if needed
                if ($query->max_num_pages > 1) {
                    echo '<div class="neo_pagination neo_shadow">';
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'prev_next' => true,
                        'prev_text' => __('« Previous', 'neo'),
                        'next_text' => __('Next »', 'neo'),
                    ));
                    echo '</div>';
                }

                wp_reset_postdata();
            } else {
                echo esc_html__('No posts found.', 'neo');
            }
            ?>
        </div>
        <?php if (get_theme_mod('feed_sidebar', true)) get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>