<?php get_header(); ?>
<main role="main">
    <section class="spacer grid">
        <div class="content error">
            <h1>File not found</h1>
            <span>😥</span>
            <a href="<?php echo esc_url(home_url('/')); ?>">Go to the home page</a>
        </div>
        <!-- <?php get_sidebar(); ?> -->
    </section>
</main>
<?php get_footer(); ?>