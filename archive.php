<?php get_header(); ?>
<main role="main">
    <section class="spacer spacerFeed grid">
        <div class="articleArea">
            <?php if (is_author()) {;
                $author_id = get_the_author_meta('ID');
                $author_name = get_the_author_meta('display_name');
                $author_description = get_the_author_meta('description');
                $author_website = get_the_author_meta('user_url');

                // Avatar
                $image_size = get_theme_mod('image_size_setting', '150');
                $author_avatar = get_avatar($author_id, $image_size);

            ?>
                <div class="author-info" id="author-bio">
                    <div class="author-avatar">
                        <?php echo $author_avatar; ?>
                    </div>
                    <div class="author-details">
                        <div class="author-row">
                            <h3><a href="<?php echo get_author_posts_url($author_id); ?>"><?php echo $author_name; ?></a>
                            </h3>
                            <?php if ($author_website && get_theme_mod('author_website', true)) : ?>
                                <a href="<?php echo $author_website; ?>" target="_blank">🌐</a>
                            <?php endif; ?>
                        </div>
                        <p><?php echo $author_description; ?></p>
                        <ul>
                            <?php
                            $author_roles = get_the_author_meta('roles');

                            if (!empty($author_roles) && get_theme_mod('author_page_role', true)) {
                                echo '<li><b>' . __('Role', 'neo') . ':</b> <span>' . $author_roles[0] . '</span></li>';
                            }

                            $author_posts_count = count_user_posts($author_id);

                            if (get_theme_mod('author_number_of_posts', true)) {
                                echo '<li><b>' . __('Number of posts', 'neo') . ':</b> <span>' . $author_posts_count . '</span></li>';
                            }

                            if (get_theme_mod('author_registration_date', true)) {
                                $user_registered = get_the_author_meta('user_registered');

                                // Convert the date to a timestamp
                                $timestamp = strtotime($user_registered);

                                // Format the date using date_i18n() into the national representation
                                $formatted_date = date_i18n(get_option('date_format'), $timestamp);

                                echo '<li><b>' . __('Registration Date', 'neo') . ':</b> <span>' . $formatted_date . '</span></li>';
                            }

                            if (get_theme_mod('author_website', true)) {
                                $author_website = get_the_author_meta('user_url');
                                echo '<li><b>' . __('Website', 'neo') . ':</b> <a href="' . $author_website . '" target="_blank">' . $author_website . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Show latest comments -->
                <?php
                if (get_theme_mod('author_page_latest_comments', true)) {
                    $args = array(
                        'user_id' => $author_id,
                        'number' => 5, // Number of comments
                    );
                    $author_comments = get_comments($args); ?>
                    <h3 class="archive-h3"><?php echo __('Last comments from', 'neo') . ' ' . $author_name; ?></h3>
                    <ol class="has-avatars has-dates has-excerpts wp-block-latest-comments">
                        <?php

                        if ($author_comments) {
                            foreach ($author_comments as $comment) {
                                echo '<li class="wp-block-latest-comments__comment" id="authorPageComments">';
                                echo get_avatar($comment->comment_author_email, 48); // Gravatar-Avatar
                                echo '<article>';
                                echo '<footer class="wp-block-latest-comments__comment-meta">';
                                echo '<a class="wp-block-latest-comments__comment-author" href="' . esc_url($comment->comment_author_url) . '">' . $comment->comment_author . '</a>';
                                echo ' zu <a class="wp-block-latest-comments__comment-link" href="' . esc_url(get_comment_link($comment)) . '">' . get_the_title($comment->comment_post_ID) . '</a>';
                                echo '<time datetime="' . esc_attr(get_comment_date('c', $comment)) . '" class="wp-block-latest-comments__comment-date">' . get_comment_date('j. F Y', $comment) . '</time>';
                                echo '</footer>';
                                echo '<div class="wp-block-latest-comments__comment-excerpt">';
                                echo '<p>' . get_comment_excerpt($comment) . '</p>'; // Comment snippet
                                echo '</div>';
                                echo '</article>';
                                echo '</li>';
                            }
                        } else {
                            echo __('No comments found.', 'neo');
                        }
                        ?>
                    </ol>
            <?php }
            } ?>

            <h1>
                <?php
                if (is_category()) {
                    echo single_cat_title(); // Category name
                } elseif (is_tag()) {
                    echo single_tag_title(); // Tag
                } elseif (is_author()) {
                    the_post();
                    echo esc_html__('Posts by', 'neo') . ' ' . get_the_author(); // Author name
                    rewind_posts();
                } elseif (is_day()) {
                    echo esc_html__('Archive for', 'neo') . ' ' . get_the_date(); // Archive for day
                } elseif (is_month()) {
                    echo esc_html__('Archive for', 'neo') . ' ' . get_the_date('F Y'); // Archive for month
                } elseif (is_year()) {
                    echo esc_html__('Archive for', 'neo') . ' ' . get_the_date('Y'); // Archive for year
                } else {
                    echo esc_html__('Archive', 'neo'); // default
                }
                ?>
            </h1>

            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $post_classes = array('postCard shadow');
                    if (is_sticky()) {
                        $post_classes[] = 'stickyPost';
                    }

                    // Show cards
                    require_once get_template_directory() . '/template-parts/feed.php';
                    echo display_post_card($post_classes);
                }

                // Pagination 
                global $wp_query;
                $total_pages = $wp_query->max_num_pages;
                if ($total_pages > 1) {
                    echo '<div class="pagination shadow">';
                    echo paginate_links(array(
                        'total' => $total_pages,
                        'prev_next' => true,
                        'prev_text' => __('« Previous', 'neo'),
                        'next_text' => __('Next »', 'neo'),
                    ));
                    echo '</div>';
                }
            } else {
                echo esc_html__('No posts found.', 'neo');
            }
            ?>
        </div>
        <?php
        $author_page_sidebar = get_theme_mod('author_page_sidebar', true);
        if (is_author()) {
            if ($author_page_sidebar) get_sidebar();
        } else get_sidebar();
        ?>
    </section>
</main>
<?php get_footer(); ?>