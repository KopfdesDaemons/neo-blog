<?php
get_header();
?>
<main class="spacer postSpacer grid">


    <?php
    while (have_posts()) {
        the_post();
    ?>

        <div id="post-<?php the_ID(); ?>" class="articleArea" <?php post_class(); ?>>

            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

            <!-- Kommentare -->
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>

        </div>

        <?php
        $pages_sidebar = get_theme_mod('pages_sidebar', false);
        if ($pages_sidebar) get_sidebar(); ?>
</main>
<?php
    }
    get_footer();
