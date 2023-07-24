<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
    ?>
    <article class="spacer" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="grid">
            <div class="content">
                <header>
                    <h1 class="title"><?php the_title(); ?></h1>
                </header>
                <span><?php the_date(); ?></span>
                <?php the_content(); ?>
                <?php echo theme_slug_social_sharing(); ?>
                <?php
                // Kommentare anzeigen
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
            endwhile;
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>

        <footer class="entry-footer">
            <!-- Weitere Inhalte wie Kategorien, Tags, Autor, Datum usw. -->
        </footer>
    </article>

</main>

<?php get_footer(); ?>