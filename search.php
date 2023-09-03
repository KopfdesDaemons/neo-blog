<?php get_header(); ?>
<main role="main">
    <section class="spacer grid">
        <div class="feed">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 10,
                'paged' => $paged
            );

            if (have_posts()) {
                $query = get_search_query();
                echo '<h1>Suchergebnisse für "' . esc_html($query) . '"</h1>';

                while (have_posts()) {
                    the_post();
                    $post_classes = array('postCard shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'stickyPost';
                    }
                    // Show cards
                    require_once get_template_directory() . '/template-parts/feed.php';
                    echo display_post_card($post_classes);
                }

                // Pagination
                if ($wp_query->max_num_pages > 1) {
                    echo '<div class="pagination shadow">';
                    echo paginate_links(array(
                        'total' => $wp_query->max_num_pages,
                        'current' => $paged,
                        'prev_next' => true,
                        'prev_text' => __('« Previous'),
                        'next_text' => __('Next »'),
                    ));
                    echo '</div>';
                }

                wp_reset_postdata();
            } else {
                echo 'Keine Beiträge gefunden.';
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>