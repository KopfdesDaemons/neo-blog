<?php get_header(); ?>
<main role="main">
    <section class="spacer grid">
        <div class="content">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
            ?>
            <article <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </article>
            <?php
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
            } else {
                // Wenn keine Beiträge gefunden werden
                echo 'Keine Beiträge gefunden.';
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>