<?php get_header(); ?>
<main role="main">
    <section class="neo_blog_content_spacer_post neo_blog_content_and_sidebar_grid">
        <div class="neo_blog_content_container">
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