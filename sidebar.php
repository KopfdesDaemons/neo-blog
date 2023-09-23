<?php
// Widget area
if (is_active_sidebar('my-sidebar')) {
    echo '<aside id="neo_blog_sidebar">';
    dynamic_sidebar('my-sidebar');
    echo '</aside>';
}
