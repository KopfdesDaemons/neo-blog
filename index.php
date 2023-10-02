<?php get_header(); ?>
<main role="main">
    <section class="neo_blog_content_spacer_post neo_blog_content_and_sidebar_grid">
        <div class="neo_blog_content_container" id="neo_blog_main_content">
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
                if ($query->max_num_pages > 1) {
                    echo '<div class="neo_blog_pagination neo_blog_shadow">';
                    echo '<div class="neo_blog_pagination_content">';

                    echo '<div class="neo_blog_pagination_controls">';
                    previous_posts_link(__('« Previous', 'neo-blog'));
                    echo '</div>';

                    echo '<div class="neo_blog_pagination_pages">';
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'prev_next' => false,
                    ));
                    echo '</div>';

                    echo '<div class="neo_blog_pagination_controls">';
                    next_posts_link(__('Next »', 'neo-blog'), $query->max_num_pages);
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // If no posts are found
                echo esc_html__('No posts found.', 'neo-blog');
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>