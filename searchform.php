<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <input name="s" id="searchinput" type="text" required spellcheck="false" placeholder="Search">


    <?php
    $search_button = get_theme_mod('search_button', false);
    if ($search_button) echo '    <input type="submit" id="searchsubmit" value="🔎">';
    ?>
</form>