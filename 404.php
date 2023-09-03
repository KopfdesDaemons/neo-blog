<?php get_header(); ?>
<main role="main">
    <section class="spacer">
        <div class="content error">
            <h1><?php esc_html_e('File not found', 'my-theme'); ?></h1>
            <span>😥</span>
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo __('Go to the home page', 'my-theme'); ?></a>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>