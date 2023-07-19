<?php
/*
Template Name: Sidebar with Article Suggestions
*/

// Get the current post ID
$current_post_id = get_queried_object_id();

// Get the most recent 5 posts
$recent_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'exclude' => $current_post_id
));

?>

<aside id="sidebar" class="shadow">
    <h2>Artikelvorschläge</h2>

    <ul>
        <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
        <hr>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </ul>
</aside>