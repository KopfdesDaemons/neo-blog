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

            if (have_posts()) {
                $search_query = get_search_query();
                echo '<h1>Suchergebnisse für "' . esc_html($search_query) . '"</h1>';

                while (have_posts()) {
                    the_post();
                    $post_classes = array('postCard shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'stickyPost';
                    }
            ?>
            <div class="<?php echo implode(' ', $post_classes); ?>">
                <?php if (has_post_thumbnail()) { ?>
                <a class="imgA" href="<?php the_permalink(); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                </a>
                <?php } ?>
                <div class="textDiv">
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                    <span class="date"><?php the_date(); ?></span>
                    <?php the_excerpt(); ?>
                    <div class="tagsDiv">
                        <?php
                                $tags = get_the_tags();
                                if ($tags) {
                                    echo '<ul>';
                                    foreach ($tags as $tag) {
                                        $tag_link = get_tag_link($tag->term_id);
                                        echo '<li><a href="' . $tag_link . '">' . $tag->name . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                                ?>
                    </div>
                    <div class="buttomDiv">
                        <a href="<?php comments_link(); ?>">
                            <?php
                                    $commentscount = get_comments_number();
                                    if ($commentscount == 1) {
                                        $commenttext = 'comment';
                                    } else {
                                        $commenttext = 'comments';
                                    }
                                    echo $commentscount . ' ' . $commenttext;
                                    ?>
                        </a>

                        <a class="readMore" href="<?php the_permalink(); ?>">read more</a>
                    </div>
                </div>
            </div>

            <?php
                }
            } else {
                $search_query = get_search_query();
                echo '<h1>Keine Suchergebnisse für "' . esc_html($search_query) . '" gefunden.</h1>';
            }
            ?>
        </div>
        <?php if ($wp_query->max_num_pages > 1) : ?>
        <div class="pagination shadow">
            <?php
                echo paginate_links(array(
                    'total' => $wp_query->max_num_pages,
                    'current' => $paged,
                    'prev_next' => true,
                    'prev_text' => __('« Previous'),
                    'next_text' => __('Next »'),
                ));
                ?>
        </div>
        <?php endif; ?>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>