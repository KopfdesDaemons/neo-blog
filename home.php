<?php get_header(); ?>
<main role="main">
    <section class="spacer grid">
        <div class="feed">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Aktuelle Seite abrufen
            $args = array(
                'post_type' => 'post', // Beitragstyp
                'posts_per_page' => 10, // Anzahl der Beiträge pro Seite
                'paged' => $paged // Aktuelle Seite übergeben
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $post_classes = array('postCard shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'stickyPost';
                    }

                    // Zeige Kachel mit Beitrag
                    require_once get_template_directory() . '/template-parts/feed.php';
                    echo display_post_card($post_classes);
                }
                // Pagination
                echo '<div class="pagination shadow">';
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'prev_next' => true,
                    'prev_text' => __('« Previous', 'my-theme'),
                    'next_text' => __('Next »', 'my-theme'),
                ));
                echo '</div>';

                wp_reset_postdata();
            } else {
                echo esc_html__('No posts found.', 'my-theme');
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>