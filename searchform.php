<form method="get" id="neo_blog_searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <input name="s" id="neo_blog_searchinput" type="text" required spellcheck="false" placeholder="<?php echo __('Search', 'neo-blog') ?>">
    <?php
    $search_button = get_theme_mod('search_button', false);
    if ($search_button) echo '    <input type="submit" id="neo_blog_search_submit" value="🔎"></input>';
    ?>
</form>