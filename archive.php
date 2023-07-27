<?php get_header(); ?>
<main role="main">
    <section class="spacer grid">
        <div class="feed">
            <?php if (is_author()) {;
                $author_id = get_the_author_meta('ID');
                $author_name = get_the_author_meta('display_name');
                $author_description = get_the_author_meta('description');
                $author_website = get_the_author_meta('user_url');

                // Avatar des Autors
                $author_avatar = get_avatar($author_id, 140); // 96 ist die Größe des Avatars in Pixeln

            ?>
                <div class="author-info">
                    <div class="author-avatar">
                        <?php echo $author_avatar; ?>
                    </div>
                    <div class="author-details">
                        <div class="author-row">
                            <h3><a href="<?php echo get_author_posts_url($author_id); ?>"><?php echo $author_name; ?></a>
                            </h3>
                            <?php if ($author_website) : ?>
                                <a href="<?php echo $author_website; ?>" target="_blank">🌐</a>
                            <?php endif; ?>
                        </div>
                        <p><?php echo $author_description; ?></p>
                        <?php $author_roles = get_the_author_meta('roles');
                        if (!empty($author_roles)) {
                            echo '<b>Role: </b>' . $author_roles[0] . ' ';
                        }
                        $author_posts_count = count_user_posts($author_id);
                        echo '<b>Number of posts: </b>' . $author_posts_count;
                        ?>
                    </div>
                </div>

                <!-- Zeige die letzten Kommentare des Autors -->
                <h3 class="archive-h3">Last comments from <?php echo $author_name; ?></h3>
                <ol class="has-avatars has-dates has-excerpts wp-block-latest-comments">
                    <?php
                    $args = array(
                        'user_id' => $author_id,
                        'number' => 5, // Anzahl der anzuzeigenden Kommentare
                    );

                    $author_comments = get_comments($args);

                    if ($author_comments) {
                        foreach ($author_comments as $comment) {
                            echo '<li class="wp-block-latest-comments__comment" id="authorPageComments">';
                            echo get_avatar($comment->comment_author_email, 48); // Gravatar-Avatar
                            echo '<article>';
                            echo '<footer class="wp-block-latest-comments__comment-meta">';
                            echo '<a class="wp-block-latest-comments__comment-author" href="' . esc_url($comment->comment_author_url) . '">' . $comment->comment_author . '</a>';
                            echo ' zu <a class="wp-block-latest-comments__comment-link" href="' . esc_url(get_comment_link($comment)) . '">' . get_the_title($comment->comment_post_ID) . '</a>';
                            echo '<time datetime="' . esc_attr(get_comment_date('c', $comment)) . '" class="wp-block-latest-comments__comment-date">' . get_comment_date('j. F Y', $comment) . '</time>';
                            echo '</footer>';
                            echo '<div class="wp-block-latest-comments__comment-excerpt">';
                            echo '<p>' . get_comment_excerpt($comment) . '</p>'; // Kommentar-Auszug
                            echo '</div>';
                            echo '</article>';
                            echo '</li>';
                        }
                    } else {
                        echo 'Keine Kommentare gefunden.';
                    }
                    ?>
                </ol>
            <?php } ?>

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