<?php get_header(); ?>
<main role="main">
    <section class="spacer">
        <?php
        $args = array(
            'post_type' => 'post', // Beitragstyp (kann angepasst werden)
            'posts_per_page' => -1 // Anzahl der Beiträge (-1 für alle Beiträge)
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_classes = array('postCard');
                if (is_sticky()) {
                    $post_classes[] = 'stickyPost';
                }
        ?>
        <div class="<?php echo implode(' ', $post_classes); ?>">
            <?php if (has_post_thumbnail()) { ?>
            <a class="imgA" href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            </a>
            <?php } ?>
            <div class="textDiv">
                <h2><?php the_title(); ?></h2>
                <span class="date"><?php the_date(); ?></span>
                <?php the_excerpt(); ?>
                <div class="tagsDiv">
                    <?php
                            $tags = get_the_tags();
                            if ($tags) {
                                echo '<ul>';
                                foreach ($tags as $tag) {
                                    $tag_link = get_tag_link($tag->term_id);
                                    echo '<li><a href="' . $tag_link . '">' . $tag->name . '</a></li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                </div>
                <div class="buttomDiv">
                    <a href="<?php comments_link(); ?>">
                        <?php
                                $commentscount = get_comments_number();
                                if ($commentscount == 1) {
                                    $commenttext = 'comment';
                                } else {
                                    $commenttext = 'comments';
                                }
                                echo $commentscount . ' ' . $commenttext;
                                ?>
                    </a>

                    <a class="readMore" href="<?php the_permalink(); ?>">read more</a>
                </div>
            </div>
        </div>
        <?php
            }
            echo wp_reset_postdata();
        } else {
            echo 'Keine Beiträge gefunden.';
        }
        ?>
    </section>

</main>
<?php get_footer(); ?>