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
                <div class="post-categories">
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

                <?php the_content(); ?>

                <!-- Tags -->
                <div class="post-tags">
                    <?php
                        $tags = get_the_tags();
                        if (!empty($tags)) {
                            echo '<ul>';
                            foreach ($tags as $tag) {
                                echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . $tag->name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                </div>


                <!-- Author -->
                <?php
                    // Autorendaten abrufen
                    $author_id = get_the_author_meta('ID');
                    $author_name = get_the_author_meta('display_name');
                    $author_description = get_the_author_meta('description');
                    $author_website = get_the_author_meta('user_url');

                    // Avatar des Autors
                    $author_avatar = get_avatar($author_id, 80); // 96 ist die Größe des Avatars in Pixeln

                    ?>
                <div class="author-info">
                    <div class="author-avatar">
                        <?php echo $author_avatar; ?>
                    </div>
                    <div class="author-details">
                        <div class="author-row">
                            <h3><a
                                    href="<?php echo get_author_posts_url($author_id); ?>"><?php echo $author_name; ?></a>
                            </h3>
                            <?php if ($author_website) : ?>
                            <a href="<?php echo $author_website; ?>" target="_blank">🌐</a>
                            <?php endif; ?>
                        </div>
                        <p><?php echo $author_description; ?></p>
                    </div>
                </div>

                <!-- Social Sharing -->
                <?php echo theme_slug_social_sharing(); ?>

                <!-- Kommentare -->
                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
            endwhile;
                ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </article>
</main>
<?php get_footer(); ?>