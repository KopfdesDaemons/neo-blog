<?php get_header(); ?>
<main role="main">
    <section class="neo_content_spacer neo_content_and_sidebar_grid">
        <div class="neo_content_container neo_error">
            <h1><?php esc_html_e('File not found', 'neo'); ?></h1>
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo __('Go to the home page', 'neo'); ?></a>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>
<?php get_footer(); ?>