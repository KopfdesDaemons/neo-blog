<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area shadow">

    <?php if (have_comments()) : ?>

    <!-- <script>
    // Event listener für den Klick auf "Antworten"-Links
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('comment-reply-link')) {
            // event.preventDefault(); // Verhindert die Standardaktion des Links
            var replyForm = event.target.closest('.reply').nextElementSibling;
            replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
        }
    });
    </script> -->

    <h2 class="comments-title">
        <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                printf(__('One Comment', 'theme-textdomain'));
            } else {
                printf(__('%d Comments', 'theme-textdomain'), $comments_number);
            }
            ?>
    </h2>

    <ul class="comment-list">
        <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 100,
                'callback'    => 'custom_comment_callback', // Verweise auf die benutzerdefinierte Funktion
            ));
            ?>
    </ul>


    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
    <nav class="comment-navigation" role="navigation">
        <div class="nav-previous"><?php previous_comments_link(__('Older Comments', 'theme-textdomain')); ?></div>
        <div class="nav-next"><?php next_comments_link(__('Newer Comments', 'theme-textdomain')); ?></div>
    </nav>
    <?php endif; ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
    <p class="no-comments"><?php _e('Comments are closed.', 'theme-textdomain'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h2>',
    ));
    ?>

</div>