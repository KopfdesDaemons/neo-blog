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

                // Pagination, falls erforderlich
                the_posts_pagination();
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