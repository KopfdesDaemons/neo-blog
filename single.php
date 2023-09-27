<?php get_header(); ?>

<main>
    <?php
    while (have_posts()) :
        the_post();
    ?>
    <article class="neo_blog_content_spacer neo_blog_content_spacer_post" id="post-<?php the_ID(); ?>"
        <?php post_class(); ?>>
        <div class="neo_blog_content_and_sidebar_grid">
            <div class="neo_blog_article">
                <div class="neo_blog_content_container" id="neo_main_content">
                    <header>
                        <h1 class="title"><?php the_title(); ?></h1>
                    </header>

                    <!-- Date -->
                    <?php
                        $post_date = get_theme_mod('post_date', true);
                        if ($post_date) { ?>
                    <span><?php the_date(); ?></span>
                    <?php } ?>

                    <!-- Categories -->
                    <?php
                        $post_categories = get_theme_mod('post_categories', true);
                        if ($post_categories) { ?>
                    <div class="neo_blog_post_categories">
                        <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<ul>';
                                    foreach ($categories as $category) {
                                        echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                                ?>
                    </div>
                    <?php } ?>
                    <?php the_content(); ?>
                </div>

                <footer>
                    <!-- Pagination-->
                    <?php
                        wp_link_pages(
                            array(
                                'before'      => '<div class="page-links"><span class="page-links-title">Seiten:</span>',
                                'after'       => '</div>',
                                'link_before' => '<span class="page-number">',
                                'link_after'  => '</span>',
                                'next_or_number' => 'number',
                            )
                        );
                        ?>

                    <!-- Tags -->
                    <?php
                        $tags_options = get_theme_mod('tags', true);
                        $tags = get_the_tags();
                        if ($tags_options & !empty($tags)) {
                            echo '<div class="neo_blog_post_tags"><ul>';
                            foreach ($tags as $tag) {
                                echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . $tag->name . '</a></li>';
                            }
                            echo '</ul></div>';
                        }
                        ?>


                    <!-- Author -->
                    <?php
                        $author_info = get_theme_mod('author_details', true);
                        if ($author_info) {
                            $author_id = get_the_author_meta('ID');
                            $author_name = esc_html(get_the_author_meta('display_name'));
                            $author_description = esc_html(get_the_author_meta('description'));
                            $author_website = esc_url(get_the_author_meta('user_url'));
                            $author_avatar = get_avatar($author_id, 80);
                        ?>
                    <div class="neo_blog_author_card">
                        <div class="neo_blog_author_avatar">
                            <?php echo $author_avatar; ?>
                        </div>
                        <div class="neo_blog_author_details">
                            <div class="neo_blog_author_name_row">
                                <h3><a
                                        href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php echo $author_name; ?></a>
                                </h3>
                                <?php if ($author_website) : ?>
                                <a href="<?php echo $author_website; ?>" target="_blank">🌐</a>
                                <?php endif; ?>
                            </div>
                            <p><?php echo $author_description; ?></p>
                        </div>
                    </div>
                    <?php } ?>

                    <?php
                        $post_pagination = get_theme_mod('post_pagination', true);
                        if ($post_pagination) { ?>
                    <div class="post-pagination">
                        <div class="pagination-prev">
                            <?php previous_post_link('%link', '&laquo; Vorheriger Beitrag'); ?>
                        </div>
                        <div class="pagination-next"><?php next_post_link('%link', 'Nächster Beitrag &raquo;'); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Comments -->
                    <?php
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                endwhile;
                    ?>
                </footer>
            </div>

            <?php
                $post_sidebar = get_theme_mod('post_sidebar', true);
                if ($post_sidebar) get_sidebar(); ?>
        </div>
    </article>
</main>
<?php get_footer(); ?>