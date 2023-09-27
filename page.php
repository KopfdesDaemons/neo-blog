<?php
get_header();
?>
<main class="neo_blog_content_spacer neo_blog_content_spacer_pages neo_blog_content_and_sidebar_grid" id="neo_main_content">

    <?php
    while (have_posts()) {
        the_post();
    ?>

        <div id="post-<?php the_ID(); ?>" class="neo_blog_article" <?php post_class(); ?>>

            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

            <!-- Comments -->
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>

        </div>

        <?php
        $pages_sidebar = get_theme_mod('pages_sidebar', true);
        if ($pages_sidebar) get_sidebar(); ?>
</main>
<?php
    }
    get_footer();
