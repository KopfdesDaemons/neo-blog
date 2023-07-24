<?php get_header(); ?>
<main role="main">
    <section class="spacer grid">
        <div class="feed">
            <h1>
                <?php
                if (is_category()) {
                    single_cat_title(); // Anzeigen des Kategorienamens für Kategorie-Archive
                } elseif (is_tag()) {
                    single_tag_title(); // Anzeigen des Schlagwortnamens für Schlagwort-Archive
                } elseif (is_author()) {
                    the_post();
                    echo 'Beiträge von ' . get_the_author(); // Anzeigen des Autorennamens für Autoren-Archive
                    rewind_posts(); // Schleife zurücksetzen, um die restlichen Schleifenfunktionen zu verwenden
                } elseif (is_day()) {
                    echo 'Archiv für ' . get_the_date(); // Anzeigen des Datums für tägliche Archive
                } elseif (is_month()) {
                    echo 'Archiv für ' . get_the_date('F Y'); // Anzeigen des Monats und Jahres für monatliche Archive
                } elseif (is_year()) {
                    echo 'Archiv für ' . get_the_date('Y'); // Anzeigen des Jahres für jährliche Archive
                } else {
                    echo 'Archiv'; // Standardtext für andere Archive
                }
                ?>
            </h1>

            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $post_classes = array('postCard shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'stickyPost';
                    }

                    // Zeige Kachel mit Beitrag
                    require_once get_template_directory() . '/template-parts/feed.php';
                    echo display_post_card($post_classes);
                }

                // Pagination (nur anzeigen, wenn es mehr als eine Seite gibt)
                global $wp_query;
                $total_pages = $wp_query->max_num_pages;
                if ($total_pages > 1) {
                    echo '<div class="pagination shadow">';
                    echo paginate_links(array(
                        'total' => $total_pages,
                        'prev_next' => true,
                        'prev_text' => __('« Previous'),
                        'next_text' => __('Next »'),
                    ));
                    echo '</div>';
                }
            } else {
                echo 'Keine Beiträge gefunden.';
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>